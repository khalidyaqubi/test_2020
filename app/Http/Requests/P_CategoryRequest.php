<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class P_CategoryRequest extends FormRequest
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
        $rules = [];
        if ($this->isMethod('post')) {
            $rules['name_en'] = 'required|max:100|unique:p_categories,name_en,NULL,id';
            $rules['name_ar'] = 'required|max:100|unique:p_categories,name_ar,NULL,id';
            $rules['name_tr'] = 'required|max:100|unique:p_categories,name_tr,NULL,id';
        }
        if ($this->isMethod('put') || $this->isMethod('patch')) {

            $id = $this->route('p_category');

            $rules['name_en'] = 'required|max:100|unique:p_categories,name_en,' . $id . ',id';
            $rules['name_ar'] = 'required|max:100|unique:p_categories,name_ar,' . $id . ',id';
            $rules['name_tr'] = 'required|max:100|unique:p_categories,name_tr,' . $id . ',id';
        }
        return $rules;
    }
}
