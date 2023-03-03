<?php

declare(strict_types=1);
/**
 * @author liguoxin
 * @email guoxinlee129@gmail.com
 */
namespace App\Service;

use Hyperf\HttpMessage\Exception\HttpException;

class ServiceException extends HttpException
{
    public $data;

    public function __construct($message = '', array $data = [], int $code = ServiceCode::FAILURE, $httpCode = 400, \Throwable $previous = null)
    {
        $this->data = $data;
        parent::__construct($httpCode, $message, $code, $previous);
    }

    public function getResponseData()
    {
        return $this->data;
    }
}
