<?php
namespace app\admin\controller;
use app\common\lib\Util;
class Live
{
    //基本信息入口  数组组装好，push到直播页面
    public function push()
    {
       print_r($_GET);
       $_POST['http_server']->push(7,'hello-push-data');
    }




}
