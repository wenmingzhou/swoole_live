<?php
use app\common\lib\task\Task as Utask;

class http {
    CONST HOST ='0.0.0.0';
    CONST PORT =8811;
    public $http =null;


    public function __construct(){
        $this->http =new swoole_http_server(self::HOST, self::PORT);
        $this->http->set([
            'enable_static_handler' => true,
            'document_root' => '/usr/local/nginx/html/swoole_live/public/static',
            'worker_num' =>2,
            'task_worker_num' =>2,
        ]);

        $this->http->on("workerstart",[$this,'onWorkerStart']);
        $this->http->on("request",[$this,'onRequest']);
        $this->http->on("task",[$this,'onTask']);
        $this->http->on("finish",[$this,'onFinish']);
        $this->http->on("close",[$this,'onClose']);
        $this->http->start();
    }

    public function onWorkerStart($server,$worker_id)
    {
        //定义目录常量
        define('APP_PATH', __DIR__ . '/../application/');
        //加载框架里面的文件
        //require __DIR__ . '/../thinkphp/base.php';
        require __DIR__ . '/../thinkphp/start.php';
    }




    public function onTask($serv,$taskId,$workerId,$data){

        //分发 task 任务机制，让不同的任务 走不同的逻辑
        //return ;
        $obj =new Utask();
        //$obj->sendSms($data['data']);

        $method =$data['method'];
        $flag =$obj->$method($data['data']);

        echo  $flag;
        /*
        $className =$_SERVER['PWD'].'/../application/common/lib/task/Task';
        $file =  str_replace('\\', '/', $className) . '.php';
        include($file);
        $obj =new Task();
        $method =$data['method'];
        $flag =$obj->$method($data['data']);
        return $flag;
        */
        /*
        try{
            $phoneNum =$data['phone'];
            $code =$data['code'];
            $response =file_get_contents("http://mysms.house365.com:81/index.php/Interface/apiSendMobil/jid/58/depart/3/city/nj/mobileno/".$phoneNum."/?msg=".urlencode($code));
        }catch (\Exception $e){
            echo $e->getMessage();
            //return Util::show(config('code.error'),'send error');
        }
        */
        print_r($data)."\n";
        sleep(100);
        return " on task finish";
    }




    public function onRequest($request,$response){
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

        $_POST['http_server'] =$this->http;
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
    }

    public function onFinish($serv,$taskId,$data){
        echo "taskId:$taskId\n";
        echo "finish-data-succes:{$data}\n";
    }


    public function onClose($ws,$fd)
    {
        echo "clientid:{$fd}"."\n";
    }

}
$obj =new Http();