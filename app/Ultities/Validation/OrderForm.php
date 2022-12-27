<?php

namespace App\Ultities\Validation;

class OrderForm extends BaseForm
{

    protected function rules()
    {
        return [
            'first_name'         => 'required|alpha',
            'last_name'          => 'required|alpha',
            'country'            => 'required',
            'street_address'     => 'required',
            'town_city'          => 'required',
            'email'              => 'required|email',
            'phone'              => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ];
    }

    protected function messages()
    {
        return [
            'first_name'         => 'First Name is required.',
            'first_name.alpha'   => 'First Name is only alphabet contains.',
            'last_name'          => 'Last Name is required.',
            'last_name.alpha'    => 'Last Name is only alphabet contains.',
            'country'            => 'Country field is required.',
            'street_address'     => 'Street Address is required.',
            'town_city'          => 'Town(city) field is required.',
            'email'              => 'E-mail is required.',
            'phone'              => 'Phone number is required',
            'phone.regex'        => 'Phone numbers field contains an invalid number.',
        ];

    }
}
