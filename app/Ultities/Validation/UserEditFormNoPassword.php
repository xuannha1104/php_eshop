<?php

namespace App\Ultities\Validation;

class UserEditFormNoPassword extends BaseForm
{

    protected function rules()
    {
        return [
            'name'                  => 'required',
            'email'                 => 'required|email',
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
            'email'                 => 'E-mail is required.',
            'country'               => 'Country field is required.',
            'street_address'        => 'Street Address is required.',
            'town_city'             => 'Town(city) field is required.',
            'phone'                 => 'Phone number is required',
            'phone.regex'           => 'Phone numbers field contains an invalid number.',
            'level'                 => 'The selected type is invalid.',
        ];
    }
}
