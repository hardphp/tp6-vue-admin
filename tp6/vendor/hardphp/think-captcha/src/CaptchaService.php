<?php

namespace hardphp\captcha;

use think\Route;
use think\Service;
use think\Validate;

class CaptchaService extends Service
{
    public function boot()
    {
        Validate::maker(function ($validate) {
            $validate->extend('captcha', function ($value) {
				$value = explode('-',$value);
                return captcha_check($value[0],$value[1]);
            }, ':attribute错误!');
        });

        $this->registerRoutes(function (Route $route) {
            $route->get('captcha/[:config]', "\\hardphp\\captcha\\CaptchaController@index");
        });
    }
}
