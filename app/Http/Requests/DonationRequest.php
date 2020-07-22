<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class  DonationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project_id'=>'required|numeric|digits_between:1,3',
            'is_monthly'=>'required|digits_between:1,1',
            'come_amount'=>'required|numeric',
        ];
    }
}
