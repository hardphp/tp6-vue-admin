<?php

namespace think\annotation;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Enum;
use Doctrine\Common\Annotations\Annotation\Target;
use think\annotation\route\Rule;

/**
 * 注册路由
 * @package topthink\annotation
 * @Annotation
 * @Target({"METHOD","CLASS"})
 */
final class Route extends Rule
{
    /**
     * 请求类型
     * @Enum({"GET","POST","PUT","DELETE","PATCH","OPTIONS","HEAD"})
     * @var string
     */
    public $method = "*";

}
