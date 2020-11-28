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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'usefull'=>'numeric|required',
            'fixing'=>'required|digits_between:1,1',
            'p_categories_ids'=>'required',
            'details_ar'=>'required',
            'details_en'=>'required',
            'details_tr'=>'required',
            'need_amount'=>'numeric',
            'come_amount'=>'numeric',
        ];
        if ($this->isMethod('post')) {
            $rules['img'] ='required|mimes:jpeg,png,jpg,gif,svg|max:6448';
            $rules['title_en'] = 'required|max:100|unique:projects,title_en,NULL,id';
            $rules['title_ar'] = 'required|max:100|unique:projects,title_ar,NULL,id';
            $rules['title_tr'] = 'required|max:100|unique:projects,title_tr,NULL,id';
        }
        if ($this->isMethod('put') || $this->isMethod('patch')) {

            $id = $this->route('project');


            $rules['title_en'] = 'required|max:100|unique:projects,title_en,' . $id . ',id';
            $rules['title_ar'] = 'required|max:100|unique:projects,title_ar,' . $id . ',id';
            $rules['title_tr'] = 'required|max:100|unique:projects,title_tr,' . $id . ',id';
        }
        if (request()->img)
            $rules['img'] ='required|mimes:jpeg,png,jpg,gif,svg|max:6448';
        return $rules;
    }
}
