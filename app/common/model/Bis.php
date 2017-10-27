<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/10/10
 * Time: 17:15
 */
namespace app\common\model;
use think\Model;

class Bis extends  BaseModel{  //BaseModel  继承这个方法，这个方法里面有新增的方法
//     //设置自动存入时间搓
//        protected $autoWriteTimestamp = true;
//      //增加的方法
//      public function add($data){
//          $data['status'] = 0; //状态默认为0
////          $data['create_time'] = time();
//          $this->save($data);
//          return $this->id;  //保存，数据，返回组件id
//      }

    /**
     * 通过$status 来获取商家数据
     * @param $status 状态
     */
     public function  getBisByStatus($status=0){
          $data = [
              'status'=>'0'
          ];
         $order = [
             'id'=>'desc'
         ];
        return  $this->where($data)
                ->order($order)
                ->paginate();  //查询所有数据
     }

//      //查询分类
//      public function getNormalFirstCategory(){
//        $data = [
//          'status'=>'1'
//        ];
//        $order = [
//            'id'=>'desc'
//        ];
//          return $this->where($data)
//                        ->order($order)
//                        ->select();  //->select(); 查询所有
//      }
//
//      //获取一级栏目 这里的$parent_id是传递过来的 默认$parent_id=0是所有的,但是一旦有值的时候他就查询他需要的
//      public  function  getFirstCategory($parent_id=0){
//          $data = [ //status 不等于-1
//              'parent_id'=>$parent_id,
//              'status'=>['neq',-1]
//          ];
//          $order = [
//              'listorder'=>'desc',  //按照listorder排序
//              'id'=>'desc'
//          ];
//          return $this->where($data)
//                      ->order($order)
//                      ->paginate();  //->paginate(2);每页显示2条,默认15条
////                    ->select();  //->select(); 查询所有
//      }
}