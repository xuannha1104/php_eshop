<?php
namespace App\Ultities\Validation;

use Illuminate\Validation\Factory;

abstract class BaseForm
{
    /**
     * @var Validator
     */
    protected $validation;

    /**
     * @var \Illuminate\Validation\Factory
     */
    private $validator;

    /**
     * @param \Illuminate\Validation\Factory $validator
     */
    public function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param array $formData
     *
     * @throws FormValidationException
     */
    public function validate(array $formData)
    {
        // Instantiate validator instance by factory
        $this->validation = $this->validator->make($formData, $this->rules(), $this->messages());

        // Validate
        if ($this->validation->fails()) {
            throw new FormValidationException( $this->getValidationErrors(),'Validation Failed');
        }

        return true;
    }

    /**
     * @return MessageBag
     */
    protected function getValidationErrors()
    {
        return $this->validation->errors();
    }

    /**
     * @return array
     */
    abstract protected function rules();

    abstract protected function messages();
}
