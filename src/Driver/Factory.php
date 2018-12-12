<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12
 * Time: 17:46
 */

namespace Sockstack\Distributedlock\Driver;

use Predis\Client;
class Factory
{
    public static function getRedis() {
        $client = new Client([
            'scheme' => 'tcp',
            'host'   => '127.0.0.1',
            'port'   => 6379,
        ]);

        return $client;
    }
}