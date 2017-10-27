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
    public function test()
    {
        return \map::getLngLat('重庆市');
    }
    public function map()
    {
        return \map::staticimage('北京雅昌文化集团');
    }
    public  function  welcome(){
       //测试邮件发送方法
      //\phpmailer\Email::send('827879040@qq.com','李霞','test php 彭进邮差小易温馨提示：建议您绿色地使用邮箱，请适当修改标题和内容，再尝试发送。');
      //return '邮件发送成功';
      return 'welcome';
    }
}
