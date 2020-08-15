<?php

namespace think\annotation;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Reader;
use ReflectionClass;
use think\annotation\model\relation\BelongsTo;
use think\annotation\model\relation\BelongsToMany;
use think\annotation\model\relation\HasMany;
use think\annotation\model\relation\HasManyThrough;
use think\annotation\model\relation\HasOne;
use think\annotation\model\relation\HasOneThrough;
use think\annotation\model\relation\MorphByMany;
use think\annotation\model\relation\MorphMany;
use think\annotation\model\relation\MorphOne;
use think\annotation\model\relation\MorphTo;
use think\annotation\model\relation\MorphToMany;
use think\App;
use think\helper\Str;
use think\ide\ModelGenerator;
use think\Model;
use think\model\Collection;

/**
 * Trait InteractsWithModel
 * @package think\annotation
 *
 * @property App $app
 * @property Reader $reader
 * @mixin Model
 */
trait InteractsWithModel
{
    protected $detected = [];

    protected function detectModelAnnotations()
    {
        if ($this->app->config->get('annotation.model.enable', true)) {

            Model::maker(function (Model $model) {
                $className = get_class($model);
                if (!isset($this->detected[$className])) {
                    $annotations = $this->reader->getClassAnnotations(new ReflectionClass($model));

                    foreach ($annotations as $annotation) {
                        switch (true) {
                            case $annotation instanceof HasOne:
                                $relation = function () use ($annotation) {
                                    return $this->hasOne(
                                        $annotation->model,
                                        $annotation->foreignKey,
                                        $annotation->localKey
                                    );
                                };
                                break;
                            case $annotation instanceof BelongsTo:
                                $relation = function () use ($annotation) {
                                    return $this->belongsTo(
                                        $annotation->model,
                                        $annotation->foreignKey,
                                        $annotation->localKey
                                    );
                                };
                                break;
                            case $annotation instanceof HasMany:
                                $relation = function () use ($annotation) {
                                    return $this->hasMany(
                                        $annotation->model,
                                        $annotation->foreignKey,
                                        $annotation->localKey
                                    );
                                };
                                break;
                            case $annotation instanceof HasManyThrough:
                                $relation = function () use ($annotation) {
                                    return $this->hasManyThrough(
                                        $annotation->model,
                                        $annotation->through,
                                        $annotation->foreignKey,
                                        $annotation->throughKey,
                                        $annotation->localKey,
                                        $annotation->throughPk
                                    );
                                };
                                break;
                            case $annotation instanceof HasOneThrough:
                                $relation = function () use ($annotation) {
                                    return $this->hasOneThrough(
                                        $annotation->model,
                                        $annotation->through,
                                        $annotation->foreignKey,
                                        $annotation->throughKey,
                                        $annotation->localKey,
                                        $annotation->throughPk
                                    );
                                };
                                break;
                            case $annotation instanceof BelongsToMany:
                                $relation = function () use ($annotation) {
                                    return $this->belongsToMany($annotation->model,
                                        $annotation->middle,
                                        $annotation->foreignKey,
                                        $annotation->localKey
                                    );
                                };
                                break;
                            case $annotation instanceof MorphOne:
                                $relation = function () use ($annotation) {
                                    return $this->morphOne(
                                        $annotation->model,
                                        $annotation->morph ?: $annotation->value,
                                        $annotation->type
                                    );
                                };
                                break;
                            case $annotation instanceof MorphMany:
                                $relation = function () use ($annotation) {
                                    return $this->morphMany(
                                        $annotation->model,
                                        $annotation->morph ?: $annotation->value,
                                        $annotation->type
                                    );
                                };
                                break;
                            case $annotation instanceof MorphTo:
                                $relation = function () use ($annotation) {
                                    return $this->morphTo($annotation->morph ?: $annotation->value, $annotation->alias);
                                };
                                break;
                            case $annotation instanceof MorphToMany:
                                $relation = function () use ($annotation) {
                                    return $this->morphToMany(
                                        $annotation->model,
                                        $annotation->middle,
                                        $annotation->morph,
                                        $annotation->localKey
                                    );
                                };
                                break;
                            case $annotation instanceof MorphByMany:
                                $relation = function () use ($annotation) {
                                    return $this->morphByMany(
                                        $annotation->model,
                                        $annotation->middle,
                                        $annotation->morph,
                                        $annotation->foreignKey
                                    );
                                };
                                break;
                        }

                        if (!empty($relation)) {
                            call_user_func([$model, 'macro'], $annotation->value, $relation);
                            unset($relation);
                        }
                    }

                    $this->detected[$className] = true;
                }
            });

            $this->app->event->listen(ModelGenerator::class, function (ModelGenerator $generator) {

                /** @var Annotation[] $annotations */
                $annotations = $this->reader->getClassAnnotations($generator->getReflection());

                foreach ($annotations as $annotation) {
                    $property = Str::snake($annotation->value);
                    switch (true) {
                        case $annotation instanceof HasOne:
                            $generator->addMethod($annotation->value, \think\model\relation\HasOne::class, [], '');
                            $generator->addProperty($property, $annotation->model, true);
                            break;
                        case $annotation instanceof BelongsTo:
                            $generator->addMethod($annotation->value, \think\model\relation\BelongsTo::class, [], '');
                            $generator->addProperty($property, $annotation->model, true);
                            break;
                        case $annotation instanceof HasMany:
                            $generator->addMethod($annotation->value, \think\model\relation\HasMany::class, [], '');
                            $generator->addProperty($property, $annotation->model . '[]', true);
                            break;
                        case $annotation instanceof HasManyThrough:
                            $generator->addMethod($annotation->value, \think\model\relation\HasManyThrough::class, [], '');
                            $generator->addProperty($property, $annotation->model . '[]', true);
                            break;
                        case $annotation instanceof HasOneThrough:
                            $generator->addMethod($annotation->value, \think\model\relation\HasOneThrough::class, [], '');
                            $generator->addProperty($property, $annotation->model, true);
                            break;
                        case $annotation instanceof BelongsToMany:
                            $generator->addMethod($annotation->value, \think\model\relation\BelongsToMany::class, [], '');
                            $generator->addProperty($property, $annotation->model . '[]', true);
                            break;
                        case $annotation instanceof MorphOne:
                            $generator->addMethod($annotation->value, \think\model\relation\MorphOne::class, [], '');
                            $generator->addProperty($property, $annotation->model, true);
                            break;
                        case $annotation instanceof MorphMany:
                            $generator->addMethod($annotation->value, \think\model\relation\MorphMany::class, [], '');
                            $generator->addProperty($property, 'mixed', true);
                            break;
                        case $annotation instanceof MorphTo:
                            $generator->addMethod($annotation->value, \think\model\relation\MorphTo::class, [], '');
                            $generator->addProperty($property, 'mixed', true);
                            break;
                        case $annotation instanceof MorphToMany:
                        case $annotation instanceof MorphByMany:
                            $generator->addMethod($annotation->value, \think\model\relation\MorphToMany::class, [], '');
                            $generator->addProperty($property, Collection::class, true);
                            break;
                    }
                }
            });
        }
    }
}
