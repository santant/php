<?php
namespace app\bis\controller;
use  think\Controller;
class Login extends  Controller
{
    public function index()
    {
        if (request()->isPost()){//如果是post方法 登录接口
            $data = input('post.'); //
            //获取用户名要严格的判断，这里省略
            //首先查询数据库这个username到底存在吗
            $ret = model('BisAccount')->get(['username'=>$data['username']]);
            if (!$ret || $ret->status !=1){ //用户不存在，或者status！=1 就是用户没审核成功
                $this->error('用户不存在，或者商户没通过审核');
            }else{
//                print_r($data['password']);
                //如果密码验证成功
                if (md5($data['password'].$ret->code) == $ret->password){

                    //如果密码正确需要跟新下最后登录的时间
                    model('BisAccount')->updateById(['last_login_time'=>time()],$ret->id);
                    //保存用户信息到session
                    session('bisAccount',$ret,'bis'); //bis下的用户的相关信息
                    return $this->success('登录成功',url('index/index'));
                }else{
                    $this->error('密码错误');
                }
            }
        }else{ //不是post就去读取模版
            //在跳转之前判断用户是否已经是登录状态,如果是登录状态就跳转到用户首页
            //获取session
            $account = session('bisAccount','','bis');
            if ($account && $account->id){ //如果session存在
                //后端跳转链接redirect
                return $this->redirect('index/index');
//                return $this->success('已有登录权限跳转首页中..',url('index/index'));
            }
 //        http://localhost:8888/think_imooc/public/bis/login
//        $citys = model('City')->getNormalCityByParentId();
            return $this->fetch('',[
//                'name'=>$account.name
            ]);
        }
    }
//    退出登录
    public  function  loginOut(){
        //获取session拿到名称
//        $account = session('bisAccount','','bis');
//        echo($account);
//        echo '退出登录';
          session(null,'bis'); //清除在bis里面对session
        //跳转到登录页面
        return $this->redirect('login/index');
    }

}
