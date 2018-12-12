<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/12
 * Time: 18:39
 */
require "../vendor/autoload.php";

use \NoahBuscher\Macaw\Macaw;
use Sockstack\Distributedlock\Impl\Lock;

Macaw::get('/demo', function() {
    $lock = new Lock();
    $lock->setKey("123123");
    $lock->setTimestamp(time()+10);

    if ($lock->lock()) {
        file_put_contents("status", "成功\n", FILE_APPEND);
//        sleep(mt_rand(1, 5));
        sleep(1);
        $lock->unlock();
        return;
    }
    file_put_contents("status", "失败\n", FILE_APPEND);
});

Macaw::dispatch();