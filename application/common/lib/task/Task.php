<?php
namespace app\common\lib\task;

/**
 * 代表的是 swoole 里面的后续所有的task异步任务 都放在这里来
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/15
 * Time: 15:56
 */

class Task{

    /**异步发布
     * @param $data
     */
    public function sendSms($data)
    {
        try{
            $phoneNum =$data['phone'];
            $code =$data['code'];
            $response =file_get_contents("http://mysms.house365.com:81/index.php/Interface/apiSendMobil/jid/58/depart/3/city/nj/mobileno/".$phoneNum."/?msg=".urlencode($code));
        }catch (\Exception $e){
            echo $e->getMessage();

            return Util::show(config('code.error'),'send error');
        }

    }


}