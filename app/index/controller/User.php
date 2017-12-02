<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/10/17
 * Time: 17:38
 */

namespace app\index\controller;
use think\Controller;
class User extends  Controller
{
    public function login() //登录
    {
        //获取session
        $user = session('o2o_user','','o2o');
        if ($user && $user->id){ //登录页面如果有session
            //跳转到首页
           $this->redirect('index/index');
        }
        return $this->fetch('',[
        ]);
    }
    public function register() //注册
    {
        if (request()->isPost()){//如果是post提交
            $data = input('post.');
            print_r($data);
           if (!captcha_check($data['verifycode'])){
               $this->error('验证码错误');
           };
            //需要tp5严格验证
           if ($data['password']!="" && $data['password'] !=$data['repassword']){
                $this->error('两次输入的密码不一样或为空');
           }
            //code md5加密
            //商户账户相关用户信息入库
            $data['code'] = mt_rand(100,100000); //随机数
            $userData = [
                'username'=>$data['username'],
                'password'=>md5($data['password'].$data['code']),
                'code'=>$data['code'],
                'email'=>$data['email']
            ];
            //判断提交的用户名是否存在
            $accountResult = model('User')->get(['username'=>$data['username']]);
            if($accountResult){
                $this->error('该用户名已经存在,请重新输入');
            }

            $accountEmail = model('User')->get(['email'=>$data['email']]);
            if($accountEmail){
                $this->error('该邮箱已经存在,请重新输入');
            }
            $userDataId = model('User')->add($userData);
            if ($userDataId){
                //如果数据成功插入到数据库，就发封邮件告诉用户
//                $title = "o2o注册成功通知";
//                $content = "恭喜您注册020成功";
//                \phpmailer\Email::send($data['email'],$title,$content);
                $this->success('注册成功',url('User/login'));
            }else{
                $this->error('注册失败');
                return;
            }
        }else{
            return $this->fetch('',[
            ]);
        }
    }
    // 登录
    public function  logincheck(){
        $data = input("post.");
       $usernameLogin =  model('User')->getUserByUserName($data['username']);
        if (!$usernameLogin || $usernameLogin->status!=1){
           return $this->error('用户名不存在');
        }else{
           //如果密码验证成功
           if (md5($data['password'].$usernameLogin->code) == $usernameLogin->password){
               //如果密码正确需要跟新下最后登录的时间
               model('User')->updateById(['last_login_time'=>time()],$usernameLogin->id);
               //保存用户信息到session
               session('o2o_user',$usernameLogin,'o2o'); //user下的用户的相关信息
               return $this->success('登录成功',url('index/index'));
           }else{
               $this->error('密码错误');
           }
        }

    }

    //退出登录
    public function logout(){
        session(null,'o2o');//晴空登录session
        //挑转链接
        return  $this->redirect('user/login');
    }
}


