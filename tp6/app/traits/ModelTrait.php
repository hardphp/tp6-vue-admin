<?php
declare (strict_types=1);

namespace app\traits;

/**
 * 模型公共方法
 * Trait ModelTrait
 * @package app\traits
 */
trait ModelTrait
{

    //模型读事件
    public static function onAfterRead($model)
    {
        if (isset($model->selectType) && $model->selectType) {
            foreach ($model->selectType as $key => $type) {
                $value = $model->getAttr($key);
                if ($value) {
                    $model->setAttr($key, transform($value, $type));
                }
            }
        }
    }

}