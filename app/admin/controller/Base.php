<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/11/7
 * Time: 15:39
 */

namespace app\admin\controller;
use think\Controller;
class Base extends Controller
{
    //修改状态 正常和待审核互换
    public function  status(){
        $data = input('get.');
        //公共的方法最重要的是获取控制器
        $model = request()->controller();
        $res= model($model)->save(['status'=>$data['status']],['id'=>$data['id']]);
        if ($res){
            $this->success('状态更新成功');
        }else{
            $this->error('状态更新失败');
        }
    }
}