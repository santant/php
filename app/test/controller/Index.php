<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\User;  //引入模型
use think\Db;  //引入数据库db类

class Index extends  Controller{
    public function index()
    {
      return 'test方法';
    }
}
