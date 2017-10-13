<?php
namespace app\index\controller;
use think\Controller;
use think\Db;  //引入数据库db类

class User extends  Controller{
    public function login() //登录
    {
        return $this->fetch('login',[
        ]);
    }
    public function register() //注册
    {
        return $this->fetch('register',[
        ]);
    }
}
