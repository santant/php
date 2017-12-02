<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/10/10
 * Time: 17:15
 */
namespace app\common\model;
use think\Model;

class BisLocation extends  BaseModel{ //BaseModel  继承这个方法，这个方法里面有新增的方法
    //设置自动存入时间搓
    protected $autoWriteTimestamp = true;
      //增加的方法
      public function add($data){
          $data['status'] = 0; //状态默认为0
//          $data['create_time'] = time();
          $this->save($data);
          return $this->id;  //保存，数据，返回组件id
      }

      //分类保存的方法
     public function  edit(){

     }

    public function  getLocationByStatus($is_main=0,$bis_id){
        $data = [
            'is_main'=> $is_main,
            'bis_id'=>$bis_id
        ];
        $order = [
            'id'=>'desc'
        ];
        return  $this->where($data)
            ->order($order)
            ->paginate();  //查询所有数据
    }
    public function  getLocationByfendian($is_main=0,$status=0){ //查询状态值不为-1的分店
        if ($status==0){
            $data = [
                'status'=>['neq',-1],
                'is_main'=> $is_main
            ];
        }else{
            $data = [
                'status'=>$status,
                'is_main'=> $is_main
            ];
        }
        $order = [
            'id'=>'desc'
        ];
        return  $this->where($data)
            ->order($order)
            ->paginate();  //查询所有数据
    }

//   根据当前的bis_id查询支持的门店
    public  function  getNormalLocationByBisId($bisId){
        $data = [
            'status'=>1,
            'bis_id'=>$bisId
        ];
        $ret = $this->where($data)->order('id','desc')->select();
        return $ret;
    }

    //根据id获取分店信息
    public function  getlocationInId($ids){
        $data = [
          'id'=>intval($ids),
            'status'=>1
        ];
        return $this->where($data)->select();
    }
}