<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/11/6
 * Time: 09:56
 */

namespace app\common\model;
use think\model;
class User extends BaseModel
{
    public function add($data){ //重写base里面的add
        $data['status'] = 1; //状态默认为0
//          $data['create_time'] = time();
        $this->allowField(true)->save($data);
        return $this->id;  //保存，数据，返回组件id
    }
    //根据用户名获取用户信息
    public function getUserByUserName($username){
//        if ($username){
//            return exception('用户名不合法');
//        }
        $data = ['username'=>$username];
        return $this->where($data)->find();
    }
}