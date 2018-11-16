<?php
namespace app\index\controller;
use app\common\lib\Util;
use app\common\lib\Redis;
use think\Exception;

class Send
{
    /**
     * 发送验证码逻辑
     */
    public function index()
    {
        //echo "555";
        //表字段用_  php变量驼峰
        //$phoneNum =request()->get('phone_num',0,'intval');
        $phoneNum =intval($_GET['phone_num']);
        //status 状态 message  data
        if(empty($phoneNum))
        {
             return Util::show(config('code.error'),'error');
        }

        //生成随机数
        $code =rand(1000,9999);

        $taskData =[
            'method' =>'sendSms',
            'data' =>[
                'phone' =>$phoneNum,
                'code' =>$code,
            ]
        ];
        $_POST['http_server']->task($taskData);
        //发送给第三方
        /*
        try{
            $phoneNum ='13770707526';
            $response =file_get_contents("http://mysms.house365.com:81/index.php/Interface/apiSendMobil/jid/58/depart/3/city/nj/mobileno/".$phoneNum."/?msg=".urlencode($code));
        }catch (\Exception $e){
            return Util::show(config('code.error'),'send error');
        }
        */
        //记录在redis
        $redis  =new \Swoole\Coroutine\Redis();

        $redis->connect(config('redis.host'),config('redis.port'));
        $redis->set(Redis::smsKey($phoneNum),$code,config('redis.out_time'));

        return Util::show(config('code.success'),'');

    }



  

}
