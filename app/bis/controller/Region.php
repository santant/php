<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/11/7
 * Time: 09:36
 */

namespace app\bis\controller;

use think\Model;
class Region extends  Base
{
    public  function  index(){
     //查询数据三级联动
    $firstCity = model('Region')->getNormalFirstCity(0);
     return  $this->fetch('',[
         'firstCity'=>$firstCity
     ]);
    }
}