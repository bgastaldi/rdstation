<?php

namespace RDStation\Exception;

class Exception extends \Exception
{
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const NOT_FOUND = 404;
    const UNSUPPORTED_MEDIA_TYPE = 415;
    const UNPROCESSABLE_ENTITY = 422;

    const TYPE_BAD_REQUEST = 'BAD_REQUEST';
    const TYPE_UNAUTHORIZED = 'UNAUTHORIZED';
    const TYPE_ACCESS_DENIED = 'ACCESS_DENIED';
    const TYPE_EXPIRED_CODE_GRANT = 'EXPIRED_CODE_GRANT';
    const TYPE_RESOURCE_NOT_FOUND = 'RESOURCE_NOT_FOUND';
    const TYPE_UNSUPPORTED_MEDIA_TYPE = 'UNSUPPORTED_MEDIA_TYPE';
    const TYPE_CANNOT_BE_NULL = 'CANNOT_BE_NULL';
    const TYPE_INVALID_FORMAT = 'INVALID_FORMAT';
    const TYPE_CANNOT_BE_BLANK = 'CANNOT_BE_BLANK';
    const TYPE_VALUES_MUST_BE_LOWERCASE = 'VALUES_MUST_BE_LOWERCASE';
    const TYPE_MUST_BE_STRING = 'MUST_BE_STRING';
    const TYPE_INVALID_FIELDS = 'INVALID_FIELDS';
    const TYPE_CONFLICTING_FIELD = 'CONFLICTING_FIELD';
    const TYPE_EMAIL_ALREADY_IN_USE = 'EMAIL_ALREADY_IN_USE';
    const TYPE_INVALID = 'INVALID';
    const TYPE_TAKEN = 'TAKEN';
    const TYPE_TOO_SHORT = 'TOO_SHORT';
    const TYPE_TOO_LONG = 'TOO_LONG';
    const TYPE_EXCLUSION = 'EXCLUSION';
    const TYPE_INCLUSION = 'INCLUSION';

    protected $errors = [];

    public function hasErrorType(string $type)
    {
        foreach ($this->errors as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $kk => $vv) {
                    if ($kk == 'error_type' && $vv == $type) {
                        return true;
                    }
                }
            } else {
                if ($k == 'error_type' && $v == $type) {
                    return true;
                }
            }
        }

        return false;
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