<?php

namespace App\Http\Controllers\Visitor;

use App\Donation;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\IPNStatus;
use App\Item;
use App\P_Category;
use App\Project;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\AdaptivePayments;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    /**
     * @var ExpressCheckout
     */
    protected $provider;
    public $project_id;
    public $p_category_id;

    public function __construct()
    {
        $this->provider = new ExpressCheckout();
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getExpressCheckout(Request $request)
    {

        $request['mode'] = $request['is_monthly'] == 1 ? "recurring" : 0;
        $request['price'] = $request['amount'];
        $recurring = ($request->get('mode') === 'recurring') ? true : false;
        $price = $request->get('price') ?? null;
        $this->project_id = $request->get('project_id') ?? null;
        $this->p_category_id = $request->get('p_category_id') ?? null;


        $cart = $this->getCheckoutData($recurring, $price);

//لهان الأمور سليمة


        try {
            $response = $this->provider->setExpressCheckout($cart, $recurring);

            return redirect($response['paypal_link']);
        } catch (\Exception $e) {
            $invoice = $this->createInvoice($cart, 'Invalid');
            session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order $invoice->id!"]);
        }
    }

    /**
     * Process payment on PayPal.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getExpressCheckoutSuccess(Request $request)
    {
        $recurring = ($request->get('mode') === 'recurring') ? true : false;
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');
        $price = $request->get('price');
        $this->project_id = $request->get('project_id') ?? null;
        $this->p_category_id = $request->get('p_category_id') ?? null;


        $cart = $this->getCheckoutData($recurring, $price);


        // Verify Express Checkout Token
        $response = $this->provider->getExpressCheckoutDetails($token);


        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            if ($recurring === true) {
                $response = $this->provider->createMonthlySubscription($response['TOKEN'], 9.99, $cart['subscription_desc']);
                if (!empty($response['PROFILESTATUS']) && in_array($response['PROFILESTATUS'], ['ActiveProfile', 'PendingProfile'])) {
                    $status = 'Processed';
                } else {
                    $status = 'Invalid';
                }

            } else {
                // Perform transaction on PayPal
                $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);

                $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
                // dd($payment_status,$status);
            }

            $invoice = $this->createInvoice($cart, $status);

            if ($invoice->paid) {
                if ($this->project_id) {
                    Donation::create(['project_id' => $this->project_id, 'amount' => $price, 'is_monthly' => $recurring]);
                    $project = Project::find($this->project_id);
                    $project->update('come_amount', $project->come_amount + $price);
                } elseif ($this->p_category_id) {
                    $projects = P_Category::find($this->p_category_id)->projects;
                    $price2 = $price / $projects->count();

                    foreach ($projects as $project) {
                        Donation::create(['project_id' => $project->id, 'amount' => $price2, 'is_monthly' => $recurring]);
                        $project->update(['come_amount' => $project->come_amount + $price2]);
                    }
                }
                session()->put(['code' => 'success', 'message' => "Donate Done successfully!"]);
            } else {
                session()->put(['code' => 'danger', 'message' => "Error , The Donate PayPal payment Faild!"]);
            }

            if ($this->project_id) {
                return redirect('/projects/' . $this->project_id . '/donations');
            } elseif ($this->p_category_id) {
                return redirect('/donations/create');
            }
        }
    }

    public function getAdaptivePay()
    {
        $this->provider = new AdaptivePayments();

        $data = [
            'receivers' => [
                [
                    'email' => 'johndoe@example.com',
                    'amount' => 10,
                    'primary' => true,
                ],
                [
                    'email' => 'janedoe@example.com',
                    'amount' => 5,
                    'primary' => false,
                ],
            ],
            'payer' => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => url('payment/success'),
            'cancel_url' => url('payment/cancel'),
        ];

        $response = $this->provider->createPayRequest($data);
        //dd($response);
    }

    /**
     * Parse PayPal IPN.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function notify(Request $request)
    {
        if (!($this->provider instanceof ExpressCheckout)) {
            $this->provider = new ExpressCheckout();
        }

        $post = [
            'cmd' => '_notify-validate',
        ];
        $data = $request->all();
        foreach ($data as $key => $value) {
            $post[$key] = $value;
        }

        $response = (string)$this->provider->verifyIPN($post);

        $ipn = new IPNStatus();
        $ipn->payload = json_encode($post);
        $ipn->status = $response;
        $ipn->save();
    }

    /**
     * Set cart data for processing payment on PayPal.
     *
     * @param bool $recurring
     *
     * @return array
     */
    protected function getCheckoutData($recurring = false, $price)
    {
        $data = [];

        $order_id = uniqid();// Invoice::all()->count() + 1;


        if ($recurring === true) {
            $data['items'] = [
                [
                    'name' => 'Monthly Subscription ' . config('paypal.invoice_prefix') . ' #' . $order_id,
                    'price' => $price,
                    'qty' => 1,
                ],
            ];

            $total = 0;

            foreach ($data['items'] as $item) {
                $total += $item['price'] * $item['qty'];
            }


            $data['total'] = $total;

            $data['return_url'] = url('/paypal/ec-checkout-success?mode=recurring&project_id=' . ($this->project_id ?? null) . '&p_category_id=' . ($this->p_category_id ?? null) . '&price=' . $total);
            $data['subscription_desc'] = 'Monthly Subscription ' . config('paypal.invoice_prefix') . ' #' . $order_id;

        } else {
            $data['items'] = [
                [
                    'name' => 'Product 1',
                    'price' => $price,
                    'qty' => 1,
                ],
            ];
            $total = 0;
            foreach ($data['items'] as $item) {
                $total += $item['price'] * $item['qty'];
            }


            $data['total'] = $total;

            $data['return_url'] = url('/paypal/ec-checkout-success?project_id=' . ($this->project_id ?? null) . '&p_category_id=' . ($this->p_category_id ?? null) . '&price=' . $total);

        }

        $data['invoice_id'] = config('paypal.invoice_prefix') . '_' . $order_id;
        $data['invoice_description'] = "Order #$order_id Invoice";
        $data['cancel_url'] = url('/');


        return $data;
    }

    /**
     * Create invoice.
     *
     * @param array $cart
     * @param string $status
     *
     * @return \App\Invoice
     */
    protected function createInvoice($cart, $status)
    {
        $invoice = new Invoice();
        $invoice->title = $cart['invoice_description'];
        $invoice->price = $cart['total'];
        if (!strcasecmp($status, 'Completed') || !strcasecmp($status, 'Processed')) {
            $invoice->paid = 1;
        } else {
            $invoice->paid = 0;
        }
        $invoice->save();

        collect($cart['items'])->each(function ($product) use ($invoice) {
            $item = new Item();
            $item->invoice_id = $invoice->id;
            $item->item_name = $product['name'];
            $item->item_price = $product['price'];
            $item->item_qty = $product['qty'];

            $item->save();
        });

        return $invoice;
    }
}
