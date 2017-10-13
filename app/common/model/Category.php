<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/10/10
 * Time: 17:15
 */
namespace app\common\model;
use think\Model;

class Category extends  Model{
    //设置自动存入时间搓
    protected $autoWriteTimestamp = true;
      //增加的方法
      public function add($data){
          $data['status'] = 1;
          $data['create_time'] = time();
          return $this->save($data);
      }

      //分类保存的方法
     public function  edit(){

     }

      //查询分类
      public function getNormalFirstCategory(){
        $data = [
          'status'=>'1'
        ];
        $order = [
            'id'=>'desc'
        ];
          return $this->where($data)
                        ->order($order)
                        ->select();  //->select(); 查询所有
      }
      //获取一级栏目 这里的$parent_id是传递过来的 默认$parent_id=0是所有的,但是一旦有值的时候他就查询他需要的
      public  function  getFirstCategory($parent_id=0){
          $data = [ //status 不等于-1
              'parent_id'=>$parent_id,
              'status'=>['neq',-1]
          ];
          $order = [
              'listorder'=>'desc',  //按照listorder排序
              'id'=>'desc'
          ];
          return $this->where($data)
                      ->order($order)
                      ->paginate();  //->paginate(2);每页显示2条,默认15条
//                    ->select();  //->select(); 查询所有
      }
}