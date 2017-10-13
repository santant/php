<?php
namespace app\admin\controller;
use think\Controller;
use app\index\model\User;  //引入模型

class Index extends  Controller{
    public function index()
    {
        return $this->fetch('index',[

        ]);
    }
    public  function  welcome(){
      return 'welcome';
    }
}
