<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/11/6
 * Time: 11:19
 */

namespace app\admin\controller;

//use think\Controller;
class Deal extends  Base
{

    private  $obj;
    public function  _initialize(){
        $this->obj = model('Deal');
    }
    //商家商品管理
    public function  index(){
       //拿到form表单传递过来的数据
       $data = input('get.');
       $datas = [];
       if (!empty($data['category_id'])){
           $datas['category_id'] = $data['category_id'];
       }
       if (!empty($data['city_id'])){
           $datas['city_id'] = $data['city_id'];
       }
       //时间都存在并且结束时间>开始时间
       if (!empty($data['start_time']) && !empty($data['end_time']) && strtotime($data['end_time'])>strtotime($data['start_time'])) {
           $datas['create_time'] = [
             ['gt',strtotime($data['start_time'])],
             ['lt',strtotime($data['end_time'])]
           ];
       }
       //模糊查询(商品)
        if (!empty($data['name'])){
            $datas['name'] = ['like','%'.$data['name'].'%'];
        }
        //查询
       $deals =  $this->obj->getNormalDeals($datas);
      //获取分类一级的数据
      $categorys = model('Category')->getFirstCategory();
      //获取城市一级的数据
      $citys = model('City')->getNormalCityByParentId();
      return  $this->fetch('',[
          'categorys'=>$categorys,
          'citys'=>$citys,
          'deals'=>$deals,
          'category_id'=>empty($data['category_id']) ? '' : $data['category_id'],
          'city_id'=>empty($data['city_id']) ? '' : $data['city_id'],
          'start_time'=>empty($data['start_time']) ? '' : $data['start_time'],
          'end_time'=>empty($data['end_time']) ? '' : $data['end_time'],
          'name'=>empty($data['name']) ? '' : $data['name']
      ]);
    }
}