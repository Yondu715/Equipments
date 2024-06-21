<?php

namespace App\Exceptions;

class InvalidSerialNumberException extends InternalException
{
    protected $code = 422;
    protected $message = "Invalid serial number";
}
