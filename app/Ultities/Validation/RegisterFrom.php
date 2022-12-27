<?php

namespace App\Ultities\Validation;

class RegisterFrom extends BaseForm
{

    protected function rules()
    {
        return [
            'name'                  => 'required|alpha',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|confirmed|between:6,32',
            'password_confirmation' => 'required|between:6,32',
        ];
    }

    protected function messages()
    {
        return [
            'name'                  =>'UserName is required.',
            'name.alpha'            =>'UserName is only alphabet contain.',
            'email.required'        => 'E-mail is required.',
            'email.unique'          => 'E-mail is available.',
            'password.required'     => 'Password is required.',
            'password.confirmed'    => 'The password confirmation does not match.',
            'password.between'      => 'password length is from 6 to 32 characters',
        ];
    }
}
