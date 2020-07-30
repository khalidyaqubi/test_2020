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
            'name' => 'required|max:30',
            ];
        if ($this->isMethod('post')) {

            $rules['password'] = 'required|string|min:8|confirmed';


            $rules['email'] = 'required|email|max:30|unique:users,email,NULL,id';
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {

            if(request()->password)
                $rules['password'] = 'required|string|min:8|confirmed';

            $id = $this->route('user');

            $rules['email'] = 'required|email|max:30|unique:users,email,' . $id . ',id';
        }
        return $rules;
    }
}
