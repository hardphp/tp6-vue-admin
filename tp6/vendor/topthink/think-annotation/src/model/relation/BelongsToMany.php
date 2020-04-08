<?php

namespace think\annotation\model\relation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 * @Annotation\Target({"CLASS"})
 */
final class BelongsToMany extends Annotation
{
    /**
     * @var string
     * @Annotation\Required
     */
    public $model;

    /**
     * @var string
     */
    public $middle = '';

    /**
     * @var string
     */
    public $foreignKey = '';

    /**
     * @var string
     */
    public $localKey = '';
}
