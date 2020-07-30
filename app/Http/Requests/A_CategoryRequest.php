<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class A_CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        if ($this->isMethod('post')) {
            $rules['name_en'] = 'required|max:100|unique:a_categories,name_en,NULL,id';
            $rules['name_ar'] = 'required|max:100|unique:a_categories,name_ar,NULL,id';
            $rules['name_tr'] = 'required|max:100|unique:a_categories,name_tr,NULL,id';
        }
        if ($this->isMethod('put') || $this->isMethod('patch')) {

            $id = $this->route('a_category');

            $rules['name_en'] = 'required|max:100|unique:a_categories,name_en,' . $id . ',id';
            $rules['name_ar'] = 'required|max:100|unique:a_categories,name_ar,' . $id . ',id';
            $rules['name_tr'] = 'required|max:100|unique:a_categories,name_tr,' . $id . ',id';
        }
        return $rules;
    }
}
