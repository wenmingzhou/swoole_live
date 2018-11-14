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

}
