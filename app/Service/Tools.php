<?php

declare(strict_types=1);
/**
 * @author liguoxin
 * @email guoxinlee129@gmail.com
 */
namespace App\Service;

use Hyperf\Logger\Logger;
use Hyperf\Utils\ApplicationContext;

class Tools
{
    /**
     * @param $plaintext | 加密字符串
     * @param mixed $cipher
     * @param mixed $options
     */
    public static function encrypt($plaintext, $cipher = 'aes-128-ecb')
    {
        if (! in_array($cipher, openssl_get_cipher_methods())) {
            throw new \LogicException('error openssl method');
        }
        // $key以前应该以加密安全的方式生成，例如openssl_random_pseudo_bytes
        // $key should have been previously generated in a cryptographically safe way, like openssl_random_pseudo_bytes
        $key = config('main.encrypt.default.key');
        $key = hex2bin($key);
        // var_dump($key);
        // $iv = config('main.encrypt.iv');
        try {
            return openssl_encrypt($plaintext, $cipher, $key);
        } catch (\Exception $e) {
            Logger::error('解密失败：' . $e->getMessage());
            return false;
        }
    }

    public static function decrypt($ciphertext, $cipher = 'aes-128-ecb')
    {
        if (! in_array($cipher, openssl_get_cipher_methods())) {
            throw new \LogicException('error openssl method');
        }
        try {
            $key = config('main.encrypt.default.key');
            $key = hex2bin($key);
            return openssl_decrypt($ciphertext, $cipher, $key);
        } catch (\Exception $e) {
            Logger::error('解密失败：' . $e->getMessage());
            return false;
        }
    }

    public static function genToken($union_id, string $salt = 'sjcz'): string
    {
        $key = config('main.encrypt.default.key');
        return md5(sprintf('%s%s%s', $key, $union_id, $salt)) . microtime(true) . md5(sprintf('%s%s%s', $key, $union_id, $salt));
    }

    public static function envIsProduction(): bool
    {
        return env('APP_ENV', 'dev') === 'production';
        // return config('app_env') === 'production';
    }

    public static function paramsFilter(&$val)
    {
        switch (true) {
            case is_array($val):
                foreach ($val as &$value) {
                    self::paramsFilter($value);
                }
                break;
            case is_string($val):
                $val = trim($val);
                break;
            default:
        }
    }

    public static function di($id = null)
    {
        $container = ApplicationContext::getContainer();
        if ($id) {
            return $container->get($id);
        }
        return $container;
    }

    /*
     * 获取 jwt 中存储在 sub 的 user_id
     */
    public static function getLoginModel($type = 'user')
    {
        $jwt = self::di(\HyperfExt\Jwt\Jwt::class);
        $id = $jwt->getClaim('sub') ?? false;
        if (is_numeric($id)) {
            switch ($type) {
                case 'user':
                    return \App\Model\User::findFromCache($id)
                        ->first();
                default:
                    return \App\Model\Admin::findFromCache($id)
                        ->first();
            }
        }
    }

    // 判断两天是否是同一天
    public static function isSameDays($last_date, $this_date)
    {
        try {
            $last_date_timestamp_getdate = getdate(strtotime($last_date));
            $this_date_timestamp_getdate = getdate(strtotime($this_date));
            if (($last_date_timestamp_getdate['year'] === $this_date_timestamp_getdate['year'])
            && ($last_date_timestamp_getdate['mon'] === $this_date_timestamp_getdate['mon'])
            && ($last_date_timestamp_getdate['mday'] === $this_date_timestamp_getdate['mday'])
            ) {
                return true;
            }
            // var_dump($last_date_timestamp_getdate['year'], $this_date_timestamp_getdate['year']);
            // var_dump($last_date_timestamp_getdate['mon'], $this_date_timestamp_getdate['mon']);
            // var_dump($last_date_timestamp_getdate['mday'], $this_date_timestamp_getdate['mday']);
        } catch (\Exception $e) {
            throw $e;
        }
        return false;
    }

    public static function getNowDate(int $timestamp = 0)
    {
        if ($timestamp) {
            return date('Y-m-d H:i:s', $timestamp);
        }
        return date('Y-m-d H:i:s');
    }

    public static function add($number1, $number2)
    {
        return (float) bcadd((string) $number1, (string) $number2, 2);
    }

    public static function mul($number1, $number2)
    {
        return (float) bcmul((string) $number1, (string) $number2, 2);
    }

    /**
     * 将字符串内的大写字母转换成下划线加小写字母.
     * @param string $str
     */
    public static function strToUnderLineSpacing($str): string
    {
        $tmp_array = [];

        for ($i = 0; $i < strlen($str); ++$i) {
            $ascii_code = ord($str[$i]);
            if ($ascii_code >= 65 && $ascii_code <= 90) {
                if ($i == 0) {
                    $tmp_array[] = chr($ascii_code + 32);
                } else {
                    $tmp_array[] = '_' . chr($ascii_code + 32);
                }
            } else {
                $tmp_array[] = $str[$i];
            }
        }

        return implode('', $tmp_array);
    }
}
