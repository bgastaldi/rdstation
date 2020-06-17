<?php

namespace RDStation\Exception;

class InvalidContentTypeHeader extends Exception
{
    public function getCode()
    {
        return self::UNSUPPORTED_MEDIA_TYPE;
    }
}