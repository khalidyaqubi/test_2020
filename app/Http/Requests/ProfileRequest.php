<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileRequest extends FormRequest
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
        $id = Auth::user()->id;


        $valid = [
            'name' => 'required|max:30',
            'email' => 'required|email|max:30|unique:users,email,' . $id . ',id',
        ];

        if (request()->password) {
            $valid['current_password'] = 'required';
            $valid['password'] = 'required|confirmed|string|min:8';
            $valid['password_confirmation'] = 'required|same:password|string|min:8';
        }

        return $valid;


    }
}
