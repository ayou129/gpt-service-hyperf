<?php

declare(strict_types=1);
/**
 * @author liguoxin
 * @email guoxinlee129@gmail.com
 */
namespace App\Controller;

use App\Service\ServiceCode;
use App\Service\ServiceException;
use App\Service\Tools;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;

class BaseController extends AbstractController
{
    /**
     * @Inject
     * @var ValidatorFactoryInterface
     */
    protected $validatorFactory;

    /**
     * 标准化返回 JSON 格式数据.
     */
    public function returnJson(string $msg = '', array $data = [], int $code = ServiceCode::WELCOME): \Psr\Http\Message\ResponseInterface
    {
        if (! $msg) {
            $msg = ServiceCode::getMessage($code);
        }

        return $this->response->json([
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ]);
    }

    /**
     * 标准化返回成功数据.
     */
    public function success(string $msg = '', array $data = [], int $code = ServiceCode::SUCCESS): \Psr\Http\Message\ResponseInterface
    {
        return $this->returnJson($msg, $data, $code);
    }

    /**
     * 标准化返回失败数据.
     */
    public function failure(string $msg = '', array $data = [], int $code = ServiceCode::FAILURE): \Psr\Http\Message\ResponseInterface
    {
        return $this->returnJson($msg, $data, $code);
    }

    public function runtime()
    {
        throw new ServiceException('', ['a']);
    }

    public function params()
    {
        $validator = $this->validatorFactory->make(
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

        if ($validator->fails()) {
            // Handle exception
            $errorMessage = $validator->errors()->first();
        }
        throw new \Hyperf\Validation\ValidationException($validator);
    }

    public function logic()
    {
        throw new \LogicException('1');
    }

    protected function getRequestAllFilter()
    {
        $array = $this->request->all();
        // $array = [
        //     1,
        //     03,
        //     ' 01 ',
        //     ' 02 ',
        //     [
        //         'a ',
        //         ' b ',
        //     ],
        //     'a' => [
        //         'a ',
        //         ' b ',
        //     ],
        //     true,
        //     '01 '
        // ];

        Tools::paramsFilter($array);
        return $array;
    }
}
