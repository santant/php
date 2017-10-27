<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/10/26
 * Time: 14:50
 */

namespace app\admin\controller;

use think\Controller;
use app\index\model\User;  //引入模型
class Bis extends  Controller
{
    private  $obj;
    public function  _initialize(){
        $this->obj = model('Bis');
    }
    /**
     * 商家入住申请列表
     */
    public  function  apply(){
        $bisData = $this->obj->getBisByStatus();
        return $this->fetch('',[
            'bisData'=>$bisData
        ]);
    }

    /**
     * 商家入住申请传入$id
     * @param $id
     */
    public  function  detail($id){
        $id = input('get.id');
        if (empty($id)){
            $this->error('ID错误');
        }
        $Category = model('Category')->getFirstCategory();
        $citys = model('City')->getNormalCityByParentId();
        $BisData =  model('Bis')->get($id);
        $locationData = model('BisLocation')->get(['bis_id'=>$id,'is_main'=>1]);
        $accountData = model('BisAccount')->get(['bis_id'=>$id,'is_main'=>1]);

//        print_r($BisData);
        //拿到三张表的数据填充到表单
        return $this->fetch('', [
            'citys' => $citys,
            'Category' => $Category,
            'BisData'=>$BisData,
            'locationData'=>$locationData,
            'accountData' =>$accountData
        ]);
    }
}