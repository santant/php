<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/10/17
 * Time: 16:02
 */

namespace app\common\model;

use think\Model;
class City extends  Model
{
    //查询城市一级目录
    public function  getNormalCityByParentId($parent_id=0){
        $data = [
            'status'=>'1',
            'parent_id'=>$parent_id
        ];
        $order = [
            'id'=>'desc'
        ];
        return $this->where($data)
            ->order($order)
            ->select();
    }

    //查询一级分类
    public function  getNormalCategoryByParentId($parent_id=0){
        $data = [
            'status'=>'1',
            'parent_id'=>$parent_id
        ];
        $order = [
            'id'=>'desc'
        ];
        return $this->where($data)
            ->order($order)
            ->select();
    }
}