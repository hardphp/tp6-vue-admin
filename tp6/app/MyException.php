<?php
declare (strict_types=1);
namespace app;

use Throwable;

/**
 * 自定义异常
 * Class MyException
 * @package app
 */
class MyException extends \RuntimeException
{
    public function __construct($code = 10001, $message = "", Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}