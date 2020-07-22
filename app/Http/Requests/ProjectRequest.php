<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
        $rules = [
            'status'=>'required|digits_between:1,1',
            'fixing'=>'required|digits_between:1,1',
            'user_id'=>'required|digits_between:1,3',
            'details_ar'=>'required',
            'the_file_ar'=>'required',
            'details_en'=>'required',
            'the_file_en'=>'required',
            'details_tr'=>'required',
            'the_file_tr'=>'required',
            'need_amount'=>'numeric',
            'come_amount'=>'numeric',
        ];
        if ($this->isMethod('post')) {
            $rules['img'] ='required|mimes:jpeg,png,jpg,gif,svg|max:6448';
            $rules['title_en'] = 'required|max:100|unique:articles,title_en,NULL,id';
            $rules['title_ar'] = 'required|max:100|unique:articles,title_ar,NULL,id';
            $rules['title_tr'] = 'required|max:100|unique:articles,title_tr,NULL,id';
        }
        if ($this->isMethod('put') || $this->isMethod('patch')) {

            $id = $this->route('article');

            $rules['title_en'] = 'required|max:100|unique:articles,title_en,' . $id . ',id';
            $rules['title_ar'] = 'required|max:100|unique:articles,title_ar,' . $id . ',id';
            $rules['title_tr'] = 'required|max:100|unique:articles,title_tr,' . $id . ',id';
        }
        if (request()->img)
            $rules['img'] ='required|mimes:jpeg,png,jpg,gif,svg|max:6448';
        return $rules;
    }
}
