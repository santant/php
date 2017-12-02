<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/11/13
 * Time: 17:29
 */

namespace app\index\controller;
//商品详情
class Detail extends Base
{
    public function index($id){
        if (!intval($id)){
            $this->error('商品不存在');
        }
        //查询当前商品信息
        $detail = model('Deal')->get($id);
        //获取栏目分类信息
       $Category = model('Category')->get($detail->category_id);
       //获取分店信息
        $locations = model('BisLocation')->getlocationInId($detail->location_ids);
        //获取活动是否开始
        $flag = 0;
        if ($detail->start_time >time()){ //活动没开始
            $flag = 1;
            echo $flag;
        }
        $va = $locations[0]['xpoint'].','.$locations[0]['ypoint'];
        return $this->fetch('',[
           'title'=>$detail->name,
           'category'=>$Category,
            'detail'=>$detail,
            'locations'=>$locations,
            'flag'=>$flag,  //活动是否开始
            'markstr'=>$locations[0]['xpoint'].','.$locations[0]['ypoint'],
            'mapSrc'=>"http://api.map.baidu.com/staticimage/v2?ak=nFjljhcL4VOp96ks4VQRC976jUHXrLYG&mcode=666666&center=$va&width=400&height=300&zoom=11"
       ]);
    }
}