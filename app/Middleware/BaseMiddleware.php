<?php

declare(strict_types=1);
/**
 * @author liguoxin
 * @email guoxinlee129@gmail.com
 */
namespace App\Middleware;

use Hyperf\Context\Context;
use Hyperf\Contract\ContainerInterface;
use Hyperf\Contract\TranslatorInterface;
use Hyperf\Utils\ApplicationContext;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BaseMiddleware implements MiddlewareInterface
{
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (! envIsProduction()) {
            // var_dump(date('Y-m-d H:i:s'), $params);
        }
        # 语言匹配
        // $container = ApplicationContext::getContainer();
        // $translator = $container->get(TranslatorInterface::class);
        $this->addLang($request);

        # 为每一个请求增加一个qid
        $request = Context::override(ServerRequestInterface::class, function (ServerRequestInterface $request) {
            // $id = $this->getRequestId();
            // var_dump($id);
            return $request;
        });

        # 利用协程上下文存储请求开始的时间，用来计算程序执行时间
        Context::set('request_start_time', microtime(true));

        $response = $handler->handle($request);

        # 洋葱模型出来之后
        $executionMicroTime = bcsub((string) microtime(true), (string) Context::get('request_start_time'), 20);
        $executionSecond = bcdiv($executionMicroTime, '1000000', 20);
        $response = $response->withAddedHeader('Execution-Second', $executionSecond);
        // $response = $response->withAddedHeader('Server-Language', $currentLang)
        // ->withAddedHeader('Request-Type', 'http');
        $response = $response->withoutHeader('Server');
        return $response->withAddedHeader('Server', config('app_name'));
    }

    public function addLang($request)
    {
        $params = $request->getQueryParams();
        if (isset($params['lang']) && is_string($params['lang'])) {
            $allowLang = ['zh_CN', 'en'];
            if (in_array(
                $params['lang'],
                $allowLang,
                true
            )) {
                Context::set('lang', $params['lang']);
            }
        }
        // var_dump($params);
    }
}
