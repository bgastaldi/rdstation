<?php

namespace RDStation\Exception;

class InvalidDataType extends Exception
{
    public function getCode()
    {
        return self::UNPROCESSABLE_ENTITY;
    }
}