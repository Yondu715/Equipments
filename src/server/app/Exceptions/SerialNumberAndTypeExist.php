<?php

namespace App\Exceptions;

class SerialNumberAndTypeExist extends InternalException
{
    protected $code = 422;
    protected $message = "The equipment with this serial number and type already exists";
}