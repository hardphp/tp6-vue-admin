<?php

namespace think\annotation\route;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class Validate
 * @package think\annotation\route
 * @Annotation
 * @Annotation\Target({"METHOD"})
 */
final class Validate extends Annotation
{
    /**
     * @var string
     */
    public $scene;

    /**
     * @var array
     */
    public $message = [];

    /**
     * @var bool
     */
    public $batch = true;
}
