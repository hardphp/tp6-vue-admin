<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace hardphp\snowflake\generator;

use InvalidArgumentException;

abstract class Generator
{

    protected $millisecondBits = 41;

    protected $dataCenterIdBits = 5;

    protected $workerIdBits = 5;

    protected $sequenceBits = 12;

    protected $sequence = 0;

    protected $lastTimestamp = 0;

    protected $beginTimestamp = 0;

    //参数初始化
    public function __construct(array $config)
    {
        if ($config['millisecondBits'] == '' || $config['dataCenterIdBits'] == '' || $config['workerIdBits'] == '' || $config['sequenceBits'] == '' || $config['beginTimestamp'] == '') {
            throw new InvalidArgumentException('The config of snowflake is error.');
        }
        $this->millisecondBits  = $config['millisecondBits'];
        $this->dataCenterIdBits = $config['dataCenterIdBits'];
        $this->workerIdBits     = $config['workerIdBits'];
        $this->sequenceBits     = $config['sequenceBits'];
        $this->beginTimestamp   = $config['beginTimestamp'];
        $this->lastTimestamp    = $this->getTimestamp();
    }

    //生成id
    public function generate(): int
    {
        $timestamp = $this->getTimestamp();

        if ($timestamp == $this->lastTimestamp) {
            $this->sequence = ($this->sequence + 1) % $this->maxSequence();
            if ($this->sequence == 0) {
                $timestamp = $this->getNextTimestamp();
            }
        } else {
            $this->sequence = 0;
        }

        if ($timestamp < $this->lastTimestamp) {
            throw new InvalidArgumentException(sprintf('Clock moved backwards. Refusing to generate id for %d milliseconds.', $this->lastTimestamp - $timestamp));
        }

        if ($timestamp < $this->beginTimestamp) {
            throw new InvalidArgumentException(sprintf('The beginTimestamp %d is invalid, because it smaller than timestamp %d.', $this->beginTimestamp, $timestamp));
        }

        $this->lastTimestamp = $timestamp;


        $interval     = $this->getTimeInterval($timestamp) << $this->getTimestampLeftShift();
        $dataCenterId = $this->getDataCenterId() << $this->getDataCenterIdShift();
        $workerId     = $this->getWorkerId() << $this->getWorkerIdShift();

        return $interval | $dataCenterId | $workerId | $this->getSequence();
    }

    //还原id
    public function degenerate(int $id): array
    {
        $interval     = $id >> $this->getTimestampLeftShift();
        $dataCenterId = $id >> $this->getDataCenterIdShift();
        $workerId     = $id >> $this->getWorkerIdShift();

        return [
            'dataCenterId'   => $interval << $this->getDataCenterIdBits() ^ $dataCenterId,
            'workerId'       => $dataCenterId << $this->getWorkerIdBits() ^ $workerId,
            'sequence'       => $workerId << $this->getSequenceBits() ^ $id,
            'timestamp'      => $interval + $this->getBeginTimestamp(),
            'beginTimestamp' => $this->getBeginTimestamp()
        ];
    }

    public function getBeginTimestamp(): int
    {
        return $this->beginTimestamp;
    }

    public function getSequence(): int
    {
        return $this->sequence;
    }

    public function getTimestampBits(): int
    {
        return $this->millisecondBits;
    }

    public function getDataCenterIdBits(): int
    {
        return $this->dataCenterIdBits;
    }

    public function getWorkerIdBits(): int
    {
        return $this->workerIdBits;
    }

    public function getSequenceBits(): int
    {
        return $this->sequenceBits;
    }

    public function maxWorkerId(): int
    {
        return -1 ^ (-1 << $this->workerIdBits);
    }

    public function maxDataCenterId(): int
    {
        return -1 ^ (-1 << $this->dataCenterIdBits);
    }

    public function maxSequence(): int
    {
        return -1 ^ (-1 << $this->sequenceBits);
    }

    public function getTimestampLeftShift(): int
    {
        return $this->sequenceBits + $this->workerIdBits + $this->dataCenterIdBits;
    }

    public function getDataCenterIdShift(): int
    {
        return $this->sequenceBits + $this->workerIdBits;
    }

    public function getWorkerIdShift(): int
    {
        return $this->sequenceBits;
    }

    public function getTimestamp(): int
    {
        return intval(microtime(true) * 1000);
    }

    public function getNextTimestamp(): int
    {
        $timestamp = $this->getTimestamp();
        while ($timestamp <= $this->lastTimestamp) {
            $timestamp = $this->getTimestamp();
        }
        return $timestamp;
    }

    public function getTimeInterval($timestamp): int
    {
        return $timestamp - $this->beginTimestamp;
    }

    abstract public function getDataCenterId(): int;

    abstract public function getWorkerId(): int;

}