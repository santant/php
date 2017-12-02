<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/11/13
 * Time: 17:29
 */

namespace app\index\controller;
use think\Controller;
//map
class Map extends Controller
{
    public function  getMapImage($data){
        //返回地图
        return \Map::staticimage($data);
    }
}