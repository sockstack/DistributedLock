<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12
 * Time: 17:41
 */

namespace Sockstack\Distributedlock;


interface ILock
{
    /**
     * 加锁
     * @return mixed
     */
    public function lock();

    /**
     * 删除锁
     * @return mixed
     */
    public function unlock();
}