<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12
 * Time: 17:38
 */

namespace Sockstack\Distributedlock\Impl;


use Sockstack\Distributedlock\Driver\Factory;
use Sockstack\Distributedlock\Exception\InvalidParamException;
use Sockstack\Distributedlock\ILock;

class Lock implements ILock
{
    private $redis;
    private $key;
    private $timestamp;
    private $expire = 5;

    /**
     * Lock constructor.
     * @param $redis
     */
    public function __construct()
    {
        $this->redis = Factory::getRedis();
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp + $this->getExpire();
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return int
     */
    public function getExpire()
    {
        return $this->expire;
    }

    /**
     * @param int $expire
     */
    public function setExpire($expire)
    {
        $this->expire = $expire;
    }

    /**
     * 加锁
     * @return mixed
     * @throws InvalidParamException
     */
    public function lock()
    {
        if (!$this->getTimestamp()) {
            throw new InvalidParamException("请设置时间戳");
        }
        // TODO: Implement lock() method.
        if( $this->redis->setnx($this->getKey(), $this->getTimestamp())) {
            return true;
        }
        $timestamp = $this->redis->get($this->getKey());
        if ($timestamp < time()) {
            $o_timestamp = $this->redis->getset($this->getKey(), $timestamp);
            if ($o_timestamp == $timestamp) {
                return true;
            }
        }

        return false;
    }

    /**
     * 删除锁
     * @return mixed
     */
    public function unlock()
    {
        // TODO: Implement unlock() method.
        $this->redis->del([$this->getKey()]);
    }
}