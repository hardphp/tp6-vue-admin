<?php

namespace app\controller;

use app\BaseController;
use app\service\UserService;
use think\annotation\route\Group;
use think\annotation\Route;

/**
 * Class Index
 * @package app\controller
 * @author  2066362155@qq.com
 * @Group("api/test")
 */
class Index extends BaseController
{
    /**
     * @Route("index", method="GET")
     */
    public function index()
    {

        $html='';
        $html='<form action="http://127.0.0.1/index.php/api/test/hello" enctype="multipart/form-data" method="post">';
        $html.='<input type="file" name="image" /><br/><br/><br/>';
        $html.='<input type="submit" value="上传" />';
        $html.='</form> ';

        echo $html;
    }

    /**
     * @param  string $name 数据名称
     * @return mixed
     * @Route("hello", method="POST")
     */
    public function hello()
    {
        $file = request()->file();

        print_r($file);

    }
}
