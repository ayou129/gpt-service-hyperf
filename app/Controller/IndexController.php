<?php

declare(strict_types=1);
/**
 * @author liguoxin
 * @email guoxinlee129@gmail.com
 */
namespace App\Controller;

class IndexController extends BaseController
{
    public function home()
    {
        return $this->returnJson();
    }
}
