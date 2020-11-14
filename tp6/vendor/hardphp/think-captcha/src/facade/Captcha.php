<?php

namespace hardphp\captcha\facade;

use think\Facade;

/**
 * Class Captcha
 * @package hardphp\captcha\facade
 * @mixin \hardphp\captcha\Captcha
 */
class Captcha extends Facade
{
    protected static function getFacadeClass()
    {
        return \hardphp\captcha\Captcha::class;
    }
}
