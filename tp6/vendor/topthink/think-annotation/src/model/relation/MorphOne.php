<?php

namespace think\annotation\model\relation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 * @Annotation\Target({"CLASS"})
 */
final class MorphOne extends Annotation
{
    /**
     * @var string
     * @Annotation\Required
     */
    public $model;

    /**
     * @var string|array
     */
    public $morph = null;

    /**
     * @var string
     */
    public $type = '';
}
