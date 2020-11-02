<?php
declare (strict_types=1);

namespace app\controller\admin;

use app\controller\admin\Base;
use think\annotation\route\Group;
use app\traits\UploadTrait;


/**
 * 文件上传
 * Class Upload
 * @package app\controller\admin
 * @author  2066362155@qq.com
 * @Group("admin/upload")
 */
class Upload extends Base
{

    use UploadTrait;
}
