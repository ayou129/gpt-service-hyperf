<?php

declare(strict_types=1);
/**
 * @author liguoxin
 * @email guoxinlee129@gmail.com
 */
namespace App\Exception\Handler;

use App\Service\ServiceCode;
use App\Service\Tools;
use Hyperf\Context\Context;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Exception\HttpException;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;

class AppExceptionHandler extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;

    public function __construct(StdoutLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(\Throwable $throwable, ResponseInterface $response): ResponseInterface
    {
        $result['data'] = [];
        $result['code'] = $throwable->getCode() === 0 ? ServiceCode::FAILURE : $throwable->getCode();
        $result['msg'] = $throwable->getMessage();
        if (! $result['msg'] || Tools::envIsProduction()) {
            $result['msg'] = ServiceCode::getMessage(ServiceCode::FAILURE);
        }
        $httpCode = 500;

        switch (true) {
            case $throwable instanceof ValidationException:
                $result['data'] = method_exists($throwable, 'getResponseData') ? $throwable->getResponseData() : [];
                $result['msg'] = $throwable->validator->errors()->first();
                $httpCode = 400;
                break;
            case $throwable instanceof HttpException:
                $result['data'] = method_exists($throwable, 'getResponseData') ? $throwable->getResponseData() : [];
                $httpCode = 400;
                break;
            case $throwable instanceof \RuntimeException:
                break;
            case $throwable instanceof \LogicException:
            default:
                break;
        }

        if (isset($result['data']) && is_array($result['data'])) {
            asort($result['data']);
        }

        if ($requestLogModel = Context::get('requestLogModel')) {
            $requestLogModel->exception_trace = $throwable->getTraceAsString();
            $requestLogModel->exception_otherinfo = 'Message:' . $throwable->getMessage() . '|Line:' . $throwable->getLine() . '|File:' . $throwable->getFile();
            $requestLogModel->save();
        }

        $this->logger->error(sprintf('%s[%s] in %s', $result['msg'] ?? $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));

        asort($result);
        if (! $result = json_encode($result, JSON_UNESCAPED_UNICODE)) {
            $result = '';
        }
        return $response
            ->withHeader('Content-Type', 'application/json;charset=utf-8')
            ->withStatus($httpCode)
            ->withBody(new SwooleStream($result));
    }

    public function isValid(\Throwable $throwable): bool
    {
        return true;
    }
}
