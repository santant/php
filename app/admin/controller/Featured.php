<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/10/26
 * Time: 14:50
 */

namespace app\admin\controller;
/**
 * 推荐位管理
 */
use think\Controller;
class Featured extends  Base
{
    private  $obj;
    public function  _initialize(){
        $this->obj = model('Featured');
    }

    public function  index(){
        $type = input('get.type',0,'intval');//默认type为0 int类型
        //查询推荐位的内容
        $slectType = $this->obj->slectType($type);
        //获取推荐位类别
        $types = config("featured.featured_type");
        return $this->fetch('',[
            'slectType'=>$slectType,
            'types'=>$types,
            'typeId'=>$type
        ]);
    }
    public  function  add(){
        if (request()->isPost()){ //post方法
            //要先验证是否通过
            $data = input('post.');
            //验证通过之后入库操作
           $id =  model("Featured")->add($data);
           if (!$id){
               $this->error('插入数据库失败');
           }else{
               $this->error('入库成功',url('featured/index'));
           }
            print_r($data);
        }else{
            //获取推荐位类别
            $types = config("featured.featured_type");

            return $this->fetch('',[
                'types'=>$types
            ]);
        }
    }
//    public function  status(){
//        $data = input('get.');
//        $res= $this->obj->save(['status'=>$data['status']],['id'=>$data['id']]);
//        if ($res){
//            $this->success('状态更新成功');
//        }else{
//            $this->error('状态更新失败');
//        }
//    }
}