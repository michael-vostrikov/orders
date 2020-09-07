<?php
namespace App\Exception;

use RuntimeException;

class LogicException extends RuntimeException
{
    const ENTITY_NOT_FOUND = 1;
    const CANNOT_ACCEPT_PAYMENT = 2;
    const VALIDATION_ERROR = 3;
    const PAYMENT_SERVICE_ERROR = 4;
}
