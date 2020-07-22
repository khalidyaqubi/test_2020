<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|max:30',
            ];
        if ($this->isMethod('post')) {

            $rules['password'] = 'required|string|min:8|confirmed';

            $rules['user_name'] = 'required|max:30|without_spaces|unique:users,user_name,NULL,id';

            $rules['email'] = 'required|email|max:30|unique:users,email,NULL,id';
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {

            $id = $this->route('user');

            $rules['user_name'] = 'required|max:30|without_spaces|unique:users,user_name,' . $id . ',id';
            $rules['email'] = 'required|email|max:30|unique:users,email,' . $id . ',id';
        }
        return $rules;
    }
}
