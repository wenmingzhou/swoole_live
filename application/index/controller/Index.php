<?php
namespace app\index\controller;

class Index
{
    public function index()
    {

        return "";
        echo  "hello,singa".PHP_EOL;
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }

    public function singa($name = 'singa')
    {
        return 'hello,' . $name;
    }



}
