<?php

namespace RDStation\Exception;

class MalformedBodyRequest extends Exception
{
    public function getCode()
    {
        return self::BAD_REQUEST;
    }
}