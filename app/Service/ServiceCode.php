<?php

declare(strict_types=1);
/**
 * @author liguoxin
 * @email guoxinlee129@gmail.com
 */
namespace App\Service;

use Hyperf\Context\Context;

class ServiceCode
{
    public const WELCOME = 1;

    public const SUCCESS = 0;

    public const FAILURE = 5000;

    public const PARAMS_ERROR = 5100;

    public const MESSAGE_MAP = [
        self::WELCOME => [
            'zh_CN' => '欢迎',
            'en' => 'welcome!',
        ],
        self::SUCCESS => [
            'zh_CN' => '操作成功',
            'en' => 'succeeded!',
        ],
        self::FAILURE => [
            'zh_CN' => '操作失败',
            'en' => 'failure!',
        ],
        self::PARAMS_ERROR => [
            'zh_CN' => '请求参数错误',
            'en' => 'Bad Request',
        ],
    ];

    public static function getMessage(int $code): string
    {
        $lang = Context::get('lang', 'zh_CN');
        return self::MESSAGE_MAP[$code][$lang] ?? '';
    }
}
