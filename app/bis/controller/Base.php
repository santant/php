<?php

namespace app\bis\controller;

use  think\Controller;

/**
 * Class Base
 * @package app\bis\controller
 * base 权限验证登录机制公共的配置
 */
class Base extends Controller
{
    public $account;

    /**
     * _initialize 在初始化的时候判断用户是否登录
     */
    public function _initialize()
    {
        //判断用户是否登录
        $isLogin = $this->isLogin();
        if ($isLogin) { //登录成功

        } else { //登录失败
            return $this->redirect('login/index');
        }
    }

    public function isLogin()
    {//判断是否登录
        //获取session
        $user = $this->getLoginUser();
        if ($user && $user->id) {
            return true;
        }
        return false;
    }

    public function getLoginUser()
    {  //获取session的方法
        //获取session
        if (!$this->account) { //如果有session付值
            $this->account = session('bisAccount', '', 'bis');
        }
        return $this->account; //没有session就
    }
}
