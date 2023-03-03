<?php

declare(strict_types=1);
/**
 * @author liguoxin
 * @email guoxinlee129@gmail.com
 */
namespace HyperfTest\Cases;

use App\Exception\Handler\AppExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use HyperfTest\HttpTestCase;

/**
 * @internal
 * @coversNothing
 */
class CoreTest extends HttpTestCase
{
    public function testGetIndexResponse()
    {
        $response = $this->request('GET', '/?lang=en');
        $body = json_decode((string) $response->getBody(), true);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals('succeeded!', $body['msg']);

        $response = $this->request('GET', '/?lang=zh_CN');
        $this->assertSame(200, $response->getStatusCode());
        $body = json_decode((string) $response->getBody(), true);
        $this->assertEquals('操作成功', $body['msg']);
    }

    public function testHandleWithValidationException()
    {
        $logger = $this->createMock(StdoutLoggerInterface::class);
        $handler = new AppExceptionHandler($logger);
        $request = $this->createMock(ServerRequestInterface::class);
        $response = $this->createMock(ResponseInterface::class);
        $validator = $validationFactory->make(
            $this->request->all(),
            [
                'foo' => 'required',
                'bar' => 'required',
            ],
            [
                'foo.required' => 'foo is required',
                'bar.required' => 'bar is required',
            ]
        );

        throw new \Hyperf\Validation\ValidationException($validator);
        $expectedData = [
            'msg' => 'The given data was invalid.',
            'data' => [],
            'code' => 1000,
        ];
        $response
            ->expects($this->once())
            ->method('withHeader')
            ->willReturnSelf();
        $response
            ->expects($this->once())
            ->method('withStatus')
            ->with(400)
            ->willReturnSelf();
        $response
            ->expects($this->once())
            ->method('withBody')
            ->with(new SwooleStream(json_encode($expectedData, JSON_UNESCAPED_UNICODE)))
            ->willReturnSelf();
        $result = $handler->handle($exception, $response);
        $this->assertEquals($response, $result);
    }

    // TODO: 添加其他异常场景的测试用例
}
