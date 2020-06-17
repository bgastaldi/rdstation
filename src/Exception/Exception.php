<?php

namespace RDStation\Exception;

class Exception extends \Exception
{
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const NOT_FOUND = 404;
    const UNSUPPORTED_MEDIA_TYPE = 415;
    const UNPROCESSABLE_ENTITY = 422;

    protected $errors = [];

    public function hasErrorType(string $type)
    {
        // @todo check if has error type
    }

    public function set(array $errors) 
    {
        $this->errors = $errors;
    }

    public function __set($name, $value) 
    {
        $this->errors[$name] = $value;
    }

    public function __get($name) 
    {
        return $this->errors[$name] ?? null;
    }

    public function __isset($name) 
    {
        return isset($this->errors[$name]);
    }

    public function __unset($name) 
    {
        unset($this->errors[$name]);
    }
}