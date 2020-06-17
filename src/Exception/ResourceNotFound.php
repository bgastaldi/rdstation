<?php

namespace RDStation\Exception;

class ResourceNotFound extends Exception
{
    public function getCode()
    {
        return self::NOT_FOUND;
    }
}