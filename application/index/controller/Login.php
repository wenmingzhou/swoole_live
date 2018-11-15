<?php
namespace app\index\controller;
use app\common\lib\Util;
use app\common\lib\Redis;
use app\common\lib\redis\Predis;

use think\Exception;

class Login
{
    /**
     * 发送验证码逻辑
     */
    public function index()
    {
        //phone code
        $phoneNum  =intval($_GET['phone_num']);
        $code       =intval($_GET['code']);
        if(empty($phoneNum) || empty($code))
        {
            return Util::show(config('code.error'),'phone or code is error');
        }
        //redis code
        try {
            $redisCode = Predis::getInstance()->get(Redis::smsKey($phoneNum));
        }catch (\Exception $e)
        {
            echo $e->getMessage();
        }

        if($redisCode==$code)
        {
            $data =[
            'user' =>$phoneNum,
            'srcKey' =>md5(Redis::userKey($phoneNum)),
            'time' =>time(),
            'isLogin' =>true,
            ];
            //写入reids
            Predis::getInstance()->set(Redis::userKey($phoneNum),$data);
            return Util::show(config('code.success'),'ok',$data);
        }else
        {
            return Util::show(config('code.error'),'login error');
        }



    }



  

}
