<?php

$http =new swoole_http_server("0.0.0.0", 8811);
$http->set([
    'document_root' => '/usr/local/nginx/html/swoole_live/public/static',
    'enable_static_handler' => true,
]);

//热加载
$http->on('WorkerStart',function ($server,$worker_id){
    //定义目录常量
    define('APP_PATH', __DIR__ . '/../application/');
    //加载框架里面的文件
    require __DIR__ . '/../thinkphp/base.php';
    //require __DIR__ . '/../thinkphp/start.php';
});
$http->on('request',function ($request,$response) use($http){
    $_SERVER =[];

    if(isset($request->server))
    {
        foreach ($request->server as $k =>$v)
        {
            $_SERVER[strtoupper($k)] =$v;
        }

    }

    if(isset($request->header))
    {
        foreach ($request->header as $k =>$v)
        {
            $_SERVER[strtoupper($k)] =$v;
        }

    }
    $_GET =[];
    if(isset($request->get))
    {
        foreach ($request->get as $k =>$v)
        {
            $_GET[$k] =$v;
        }

    }

    $_POST =[];
    if(isset($request->post))
    {
        foreach ($request->post as $k =>$v)
        {
            $_POST[$k] =$v;
        }
    }
    // 执行应用并响应
    ob_start();
    try{
    think\Container::get('app', [APP_PATH])
        ->run()
        ->send();
    }catch (\Exception $e){
        //todo
    }
    //echo "-action-".request()->action().PHP_EOL;
    $res =ob_get_contents();
    ob_end_clean();
    $response->end($res);
    //$http->close(false);

});


$http->start();
