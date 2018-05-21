<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/9
 * Time: 16:33
 */
$http = new swoole_http_server("0.0.0.0", 9501);
$http->set(array(
 'worker_num' => 4,    //worker process num
 'backlog' => 128,   //listen backlog
 'max_request' => 2,
));

$http->on("start", function ($http) {
  echo "系统开始运行可以通过地址访问 http://127.0.0.1:9501\n";
});

$http->on("request", function ($http, $response) {
  $response->header("Content-Type", "text/html; charset=utf-8");
  \style\longrbl::run($http, $response);
});

$http->on('WorkerStart', function ($http, $worker_id) {
    include 'index.php';
});

$http->start();