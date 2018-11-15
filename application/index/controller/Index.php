<?php
namespace app\index\controller;

class Index
{
    public function index()
    {

        echo  "hello,singa".PHP_EOL;
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }


    public function Send($mobile)
    {
        $mobile ='13770707526';
        $msg ='123456';
        //file_get_contents("http://mysms.house365.com:81/index.php/Interface/apiSendMobil/jid/58/depart/3/city/nj/mobileno/".$mobile."/?msg=".urlencode($msg));
    }

}
