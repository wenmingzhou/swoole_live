<?php
namespace app\admin\controller;
use app\common\lib\Util;
class Live
{
    //������Ϣ���  ������װ�ã�push��ֱ��ҳ��
    public function push()
    {
       print_r($_GET);
       $_POST['http_server']->push(7,'hello-push-data');
    }




}
