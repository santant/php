<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/11/1
 * Time: 16:55
 */

namespace app\bis\controller;

use think\Controller;
class Deal extends  Base
{
    public function  add(){
//        session得到
        $bisId= $this->getLoginUser()->bis_id; //session得到
        if (request()->isPost()){ //如果是post请求
            //验证数据
            $data = input("post.");

            //验证表单 ->check
            $validate = validate('Deal');
            if(!$validate->scene('add')->check($data)){//验证失败
                $this->error($validate->getError());
            }
            //获取经纬度，只拿到对应1个门店的经纬度就可以了
            $location = model('bisLocation')->get($data['location_ids'][0]);
            echo $data['location_ids'][0];
            print_r($location->xpoint);
            //验证通过入库
            $deals = [
                'bis_id'=>$bisId,
                'name'=>htmlentities($data['name']),
                'image'=>$data['image'],
                'category_id'=>$data['category_id'],
                'se_category_id'=>$data['category_id'].','.$data['se_category_id'],
                'city_id'=>$data['city_id'],
//              'se_city_id'=>$data['city_id'].','.$data['se_city_id'], //城市第二级
                'location_ids'=>implode(',',$data['location_ids']),
                'category_id'=>$data['category_id'],
                'start_time'=>strtotime($data['start_time']),
                'end_time'=>strtotime($data['end_time']),
                'total_count'=>$data['total_count'],
                'origin_price'=>$data['origin_price'], //原价
                'current_price'=>$data['current_price'], //当前价
                'coupons_begin_time'=>strtotime($data['coupons_begin_time']),//消费卷开始时间
                'coupons_end_time'=>strtotime($data['coupons_end_time']),//消费卷end时间
                'description'=>$data['description'],//描述
                'notes'=>$data['notes'], //商品须知
                'bis_account_id'=>$this->getLoginUser()->id, //用户id
                'xpoint'=>$location->xpoint,
                'ypoint'=>$location->ypoint
            ];

            //数据入库
            $id = model('Deal')->add($deals);
            if ($id){
                $this->success('添加成功',url('deal/index'));
            }else{
                $this->error('添加失败');
            }
        }else{//get方法

            $Category = model('Category')->getFirstCategory();
            $citys = model('City')->getNormalCityByParentId();
            //得到支持门店的list集合

            $bislocations = model('BisLocation')->getNormalLocationByBisId($bisId);

            return $this->fetch('', [
                'citys' => $citys,
                'Category' => $Category,
                'bislocations'=>$bislocations
            ]);

        }
    }
    public function index(){
//        echo  'index';
        $bisId= $this->getLoginUser()->bis_id;
        //拿到商户id去查询他对应的沟通商品申请
        $DealData = model('Deal')->getDealDataByBisId($bisId,0);
        return  $this->fetch('',[
            'dealData'=>$DealData
        ]);
    }
}