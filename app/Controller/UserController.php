<?php

declare(strict_types=1);
/**
 * @author liguoxin
 * @email guoxinlee129@gmail.com
 */
namespace App\Controller;

class UserController extends BaseController
{
    public function info()
    {
        return $this->success('', [
            'username' => 'name',
            'title' => 'title',
        ]);
    }
}
