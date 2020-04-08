<?php

namespace think\annotation\route;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * 路由中间件
 * @package think\annotation\route
 * @Annotation
 * @Target({"CLASS","METHOD"})
 */
final class Middleware extends Annotation
{

}
