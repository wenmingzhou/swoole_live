<?php
/**¼à¿Ø·þÎñ ws http  8811
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/20
 * Time: 14:31
 */
class Server{
    const PORT =8811;
    public function port()
    {
        $shell ="netstat -ant | grep ".self::PORT ." | grep LISTEN | wc -l";

        $result =shell_exec($shell);

        if($result!=1)
        {
            echo date("Ymd H:i:s")."---error";
        }else
        {
            echo date("Ymd H:i:s")."---success";
        }
    }
}

swoole_timer_tick(2000,function ($timer_id){
    (new Server())->port();
    echo "---time-start".PHP_EOL;
});
