<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/15
 * Time: 10:31
 */
namespace app\common\lib;
class Util
{
    /**ApiÊä³ö¸ñÊ½
     * @param $status
     * @param string $mesage
     * @param array $data
     */
    public static function show($status,$message='',$data =[])
    {
        $result  =[
            'status'=>$status,
            'message'=>$message,
            'data'=>$data,
            ];

        echo  json_encode($result);
    }
}