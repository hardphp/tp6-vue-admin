<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: hardphp <hardphp@163.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace hardphp\snowflake\generator\meta;

use hardphp\snowflake\generator\Generator;

class Local extends Generator
{
    protected $dataCenterId;

    protected $workerId;

    public function __construct($config)
    {
        parent::__construct($config);
        $this->dataCenterId = $config['dataCenterId'];
        $this->workerId     = $config['workerId'];
    }

    public function getDataCenterId(): int
    {
        return $this->dataCenterId;
    }

    public function getWorkerId(): int
    {
        return $this->workerId;
    }
}
