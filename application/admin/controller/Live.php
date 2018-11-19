<?php
namespace app\admin\controller;
use app\common\lib\Util;
use app\common\lib\redis\Predis;
class Live
{
    //基本信息入口  数组组装好，push到直播页面
    public function push()
    {
        if(empty($_GET)) {
            return Util::show(config('code.error'),'error');
        }

        $teams =[
            1=>[
                'name'=>'马刺',
                'logo'=>'/live/imgs/team1.png',
            ] ,

            4=>[
                'name'=>'火箭',
                'logo'=>'/live/imgs/team2.png',
            ]
        ];


        $data =[
            'type' =>intval($_GET['type']),
            'title' =>!empty($teams[$_GET['team_id']]['name']) ?  $teams[$_GET['team_id']]['name'] :'直播员',
            'logo' =>!empty($teams[$_GET['team_id']]['logo']) ?  $teams[$_GET['team_id']]['logo'] :'',
            'content' =>!empty($_GET['content']) ?  $_GET['content'] :'',
            'image' =>!empty($_GET['image']) ?  $_GET['image']:'',
        ];


       $clients =Predis::getInstance()->sMembers(config("redis.live_game_key"));


       foreach ($clients as $fd)
       {
           $_POST['http_server']->push($fd,json_encode($data));
       }
       //$_POST['http_server']->push(7,'hello-push-data');
    }




}
