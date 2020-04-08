<?php

namespace think\annotation\route;

use Doctrine\Common\Annotations\Annotation;

abstract class Rule extends Annotation
{
    /**
     * @var string|array
     */
    public $middleware;

    /**
     * 后缀
     * @var string
     */
    public $ext;

    /**
     * @var string
     */
    public $deny_ext;

    /**
     * @var bool
     */
    public $https;

    /**
     * @var string
     */
    public $domain;

    /**
     * @var bool
     */
    public $complete_match;

    /**
     * @var string|array
     */
    public $cache;

    /**
     * @var bool
     */
    public $ajax;

    /**
     * @var bool
     */
    public $pjax;

    /**
     * @var bool
     */
    public $json;

    /**
     * @var array
     */
    public $filter;

    /**
     * @var array
     */
    public $append;

    public function getOptions()
    {
        return array_intersect_key(get_object_vars($this), array_flip([
            'middleware', 'ext', 'deny_ext', 'https', 'domain', 'complete_match', 'cache', 'ajax', 'pjax', 'json', 'filter', 'append',
        ]));
    }

}
