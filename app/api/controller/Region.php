<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/10/17
 * Time: 17:38
 */

namespace app\api\controller;
use think\Controller;
class Region extends  Controller
{
    private  $obj;
    public function _initialize(){
        $this->obj = model('Region');
    }
    public function  getCityByPid(){
        $id = input('get.id');
//        //获取二级城市
        $city = $this->obj->getNormalCityByPid($id);
        if (!$city){
            return json(show(0,$city,'error'));
        }
        return json(show(1,$city,'success'));
    }
}