<?php
namespace app\index\controller;
use app\common\lib\Util;
class Send
{
    /**
     * ������֤���߼�
     */
    public function index()
    {
        //echo "555";

        //���ֶ���_  php�����շ�
        $phoneNum =request()->get('phone_num',0,'intval');
        //status ״̬ message  data
        if(empty($phoneNum))
        {
             return Util::show(config('code.error'),'error');
        }

        //���������

        //���͸�������


        //��¼��redis


    }



  

}
