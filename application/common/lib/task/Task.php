<?php
namespace app\common\lib\task;
use app\common\lib\redis\Predis;
use app\common\lib\Redis;
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
    public function sendSms($data,$serv)
    {
        try{
            $phoneNum =$data['phone'];
            $code =$data['code'];
            $response =file_get_contents("http://mysms.house365.com:81/index.php/Interface/apiSendMobil/jid/58/depart/3/city/nj/mobileno/".$phoneNum."/?msg=".urlencode($code));
        }catch (\Exception $e){
            echo $e->getMessage();

            return Util::show(config('code.error'),'send error');
        }


        Predis::getInstance()->set(Redis::smsKey($phoneNum),$code,config('redis.out_time'));


    }

    /**通过task机制赛况数据发送用户
     * @param $data
     */

    public function pushLive($data,$serv)
    {


        $clients =Predis::getInstance()->sMembers(config("redis.live_game_key"));


        foreach ($clients as $fd)
        {
            $serv->push($fd,json_encode($data));
        }
    }


}