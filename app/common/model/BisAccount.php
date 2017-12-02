<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/10/10
 * Time: 17:15
 */
namespace app\common\model;
use think\Model;

class BisAccount extends  BaseModel{ //BaseModel  继承这个方法，这个方法里面有新增的方法
    //设置自动存入时间搓
//    protected $autoWriteTimestamp = true;
//      //增加的方法
//      public function add($data){
//          $data['status'] = 0; //状态默认为0
////          $data['create_time'] = time();
//          $this->save($data);
//          return $this->id;  //保存，数据，返回组件id
//      }

      //分类保存的方法
     public function  edit(){

     }
    //用户登录的时候更新最后1次登录时间
    public function  updateById($data,$id){
         //allowField(true) 检测数据库里面的数据是否合法
        return $this->allowField(true)->save($data,['id'=>$id]);
    }

}