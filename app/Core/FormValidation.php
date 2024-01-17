<?php
namespace App\Core;

class FormValidation
{
    private $errors = [];

    public function validateRequired($value, $fieldName)
    {
        if (empty($value)) {
            $this->addError("The field {$fieldName} is required.");
        }
    }

    public function validateNumber($number, $fieldName)
    {
        if (!filter_var($number, FILTER_VALIDATE_FLOAT)) {
            $this->addError("The field {$fieldName} is not a valid number.");
        }
    }

    public function addError($errorMessage)
    {
        $this->errors[] = $errorMessage;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function hasErrors()
    {
        return count($this->errors) > 0;
    }
}