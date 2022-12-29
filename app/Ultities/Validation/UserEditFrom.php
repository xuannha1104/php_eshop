<?php

namespace App\Ultities\Validation;


class UserEditFrom extends BaseForm
{
    protected function rules()
    {
        return [
            'name'                  => 'required',
            'email'                 => 'required|email',
            'password'              => 'required|confirmed|between:6,32',
            'password_confirmation' => 'required|between:6,32',
            'country'               => 'required',
            'street_address'        => 'required',
            'town_city'             => 'required',
            'phone'                 => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'level'                 => 'required'
        ];
    }

    protected function messages()
    {
        return [
            'name'                  => 'Name is required.',
            'email.required'        => 'E-mail is required.',
            'password.required'     => 'Password is required.',
            'password.confirmed'    => 'The password confirmation does not match.',
            'password.between'      => 'password length is from 6 to 32 characters',
            'country'               => 'Country field is required.',
            'street_address'        => 'Street Address is required.',
            'town_city'             => 'Town(city) field is required.',
            'phone'                 => 'Phone number is required',
            'phone.regex'           => 'Phone numbers field contains an invalid number.',
            'level'                 => 'The selected type is invalid.',
        ];
    }
}
