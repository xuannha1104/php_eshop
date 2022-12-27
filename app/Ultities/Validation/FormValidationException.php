<?php

namespace App\Ultities\Validation;

use Exception;
use Illuminate\Support\MessageBag;

class FormValidationException extends \Exception
{
    /**
     * @var MessageBag
     */
    protected $errors;

    /**
     * @param string     $message
     * @param MessageBag $errors
     * @param int        $code
     * @param Exception  $previous
     */
    public function __construct( MessageBag $errors, $message = "", $code = 0, Exception $previous = null)
    {
        $this->errors = $errors;

        parent::__construct($message, $code, $previous);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
