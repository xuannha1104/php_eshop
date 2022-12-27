<?php

namespace App\Ultities\Validation;

class LoginForm extends BaseForm
{

    protected function rules()
    {
        return [
            'email'    => 'required|email',
            'password' => 'required|between:6,32'
        ];
    }

    protected function messages()
    {
        return [
            'email.required'        => 'Email is required.',
            'password.required'     => 'Password is required.',
            'password.between'      => 'password length is from 6 to 32 characters',
        ];
    }
}
