<?php
namespace app\common\lib\task;

/**
 * ������� swoole ����ĺ������е�task�첽���� ������������
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/15
 * Time: 15:56
 */

class Task{

    /**�첽����
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