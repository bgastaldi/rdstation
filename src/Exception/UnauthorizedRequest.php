<?php

namespace RDStation\Exception;

class UnauthorizedRequest extends Exception
{
    public function getCode()
    {
        return self::UNAUTHORIZED;
    }
}