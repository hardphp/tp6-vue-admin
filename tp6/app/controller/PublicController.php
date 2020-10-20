<?php

    namespace app\controller;

    use app\BaseController;
    use think\annotation\route\Group;
    use think\annotation\Route;

    /**
     * Class Index
     * @package app\controller
     * @author  thinkwei2012@gmail.com
     * @Group("/")
     */
    class PublicController extends BaseController
    {
        /**
         * 解决验证码问题
         * @return mixed
         * @Route("captcha", method="GET")
         */
        public function getCaptcha()
        {
            return captcha();
        }
    }
