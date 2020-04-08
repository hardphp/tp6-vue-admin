<?php

namespace think\annotation\model\relation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 * @Annotation\Target({"CLASS"})
 */
final class HasOneThrough extends Annotation
{

    /**
     * @var string
     * @Annotation\Required
     */
    public $model;

    /**
     * @var string
     * @Annotation\Required
     */
    public $through;

    /**
     * @var string
     */
    public $foreignKey = '';

    /**
     * @var string
     */
    public $throughKey = '';

    /**
     * @var string
     */
    public $localKey = '';

    /**
     * @var string
     */
    public $throughPk = '';
}
