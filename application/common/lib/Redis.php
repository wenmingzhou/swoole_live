<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/15
 * Time: 10:31
 */
namespace app\common\lib;
class Redis
{
    public static $pre ="sms_";

    public static $userpre ="user_";
    public static function  smsKey($phone)
    {
        return self::$pre.$phone;
    }

    public static function userKey($phone){
        return self::$userpre.$phone;
    }
}