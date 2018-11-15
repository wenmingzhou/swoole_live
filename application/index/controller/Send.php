<?php
namespace app\index\controller;
use app\common\lib\Util;
class Send
{
    /**
     * 发送验证码逻辑
     */
    public function index()
    {
        //echo "555";

        //表字段用_  php变量驼峰
        $phoneNum =request()->get('phone_num',0,'intval');
        //status 状态 message  data
        if(empty($phoneNum))
        {
             return Util::show(config('code.error'),'error');
        }

        //生成随机数

        //发送给第三方


        //记录在redis


    }



  

}
