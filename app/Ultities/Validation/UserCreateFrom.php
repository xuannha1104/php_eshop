<?php

namespace App\Ultities\Validation;

class UserCreateFrom extends baseForm
{

    protected function rules()
    {
        return [
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|confirmed|between:6,32',
            'password_confirmation' => 'required|between:6,32',
            'country'               => 'required',
            'street_address'        => 'required',
            'town_city'             => 'required',
            'phone'                  => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'level'                 => 'min:0'
        ];
    }

    protected function messages()
    {
        return [
            'name'                  => 'Name is required.',
            'email.required'        => 'E-mail is required.',
            'email.unique'          => 'E-mail is available.',
            'password.required'     => 'Password is required.',
            'password.confirmed'    => 'The password confirmation does not match.',
            'password.between'      => 'password length is from 6 to 32 characters',
            'country'            => 'Country field is required.',
            'street_address'     => 'Street Address is required.',
            'town_city'          => 'Town(city) field is required.',
            'email'              => 'E-mail is required.',
            'phone'              => 'Phone number is required',
            'phone.regex'        => 'Phone numbers field contains an invalid number.',
            'level.min'        => 'level must be choose.',
        ];
    }
}
