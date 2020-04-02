<?php
declare (strict_types=1);

namespace app\job;

use think\queue\Job;
use app\service\SmsService;
use app\service\FailedJobsService;
use think\facade\SnowFlake;

/**
 * 短信任务
 * Class Sms
 * @package app\job
 * @author 2066362155@qq.com
 */
class Sms
{
    //任务处理
    public function fire(Job $job, $data)
    {
        //尝试3次失败剔除任务
        if ($job->attempts() > 3) {
            $job->delete();
        }
        $res = SmsService::sendSms($data);
        if ($res) {
            //执行成功删除任务
            $job->delete();
        } else {
            //延迟时间10s执行
            $job->release(10);
        }


    }

    public function failed($data)
    {
        //失败任务保存到数据库
        FailedJobsService::save([
            'id'          => SnowFlake::generate(),
            'type'        => 2,
            'data'        => json_encode($data),
            'create_time' => time(),
            'update_time' => time(),
        ]);
    }

}