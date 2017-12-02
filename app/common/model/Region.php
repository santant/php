<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/11/6
 * Time: 09:56
 */

namespace app\common\model;

use think\model;
class Region extends BaseModel
{
    //查询地址第一级联动
    public function getNormalFirstCity($pid=0){
        $data = [
            'Pid'=>$pid
        ];
//        $order=[
//            'Id'=>'desc'
//        ];
        return $this->where($data)
//            ->order($order)
            ->select();  //->select(); 查询所有
    }

    //根据id查询二2级联动
    public function getNormalCityByPid($id){
        $data = [
            'Pid'=>$id
        ];
        return $this->where($data)
//            ->order($order)
              ->select();  //->select(); 查询所有
    }
}