<?php

namespace App\Ultities\Validation;

class ProductCreateForm extends BaseForm
{

    protected function rules()
    {
        return [
            'name'                  => 'required',
            'price'                 => 'required|regex:[0-9]+[.,]?[0-9]*',
        ];
    }

    protected function messages()
    {
        return [
            'name'                  => 'Name is required.',
            'price.required'        => 'Price is not null.',
            'price.regex'         => 'Price is number input.',
        ];
    }
}
