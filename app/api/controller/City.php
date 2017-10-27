<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/10/17
 * Time: 17:38
 */

namespace app\api\controller;
use think\Controller;
class City extends  Controller
{
    private  $obj;
    public function _initialize(){
        $this->obj = model('City');
    }
    public function  getCityByParentId(){
        $id = input('post.id');
        if (!$id){
            $this->error('ID不合法');
        }
        //获取二级城市
        $city = $this->obj->getNormalCityByParentId($id);
//        print_r($city);
        //调用common.php里面show自定义返回的方法
        if (!$city){
            return show(0,$city,'error');
        }
        return show(1,$city,'success');
    }
}