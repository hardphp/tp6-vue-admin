<?php

namespace think\facade;

use think\Facade;

/**
 * Class Snowflake
 * @package think\facade
 */
class Snowflake extends Facade
{
    protected static function getFacadeClass()
    {
        return 'snowflake';
    }
}
