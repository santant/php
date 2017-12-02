<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/10/30
 * Time: 15:53
 */

namespace app\bis\controller;

use think\Controller;
class Location  extends   Base
{
    public $obj;
    public function  _initialize(){
        $this->obj = model('BisLocation');
    }
    //分店增加逻辑
    public function add(){
        //如果是post方式提交
        if(request()->isPost()){
            //验证
            //获取表单的值
            $data = input("post.");
            //现在已经是登录状态从session里面拿到bis_id(从继承的base类里面获取)
            $bisId = $this->getLoginUser()->bis_id;
            //得到地图标注的点（经纬度）  继承extend里面的map类
            $lnglat = \Map::getLngLat($data['address']);
            if (empty($lnglat) || $lnglat['status'] != 0 || $lnglat['result']['precise'] != 1) {
                $this->error('无法获取数据，或获取的数据不精确');
            }
            //分店入库操作
            $locationData = [
                'bis_id' => $bisId, //总店相关信息需要关联商户基本信息id
                'tel' => $data['tel'],//电话
                'name' => htmlentities($data['name']),//法人
                'logo' => $data['logo'],//法人
                'contact' => $data['contact'],//联系人
                'category_id' => $data['category_id'],//发布产品主分类
                'category_path' => $data['category_id'].','.$data['category_path'],//分类
                'city_id' => $data['city_id'],
                'city_path' => empty($data['se_city_id']) ? $data['city_id'] : $data['city_id'] . ',' . $data['se_city_id'],
                'address' => $data['address'],//地址
                'open_time' => $data['open_time'],//营业时间
                'content' => empty($data['content']) ? '' : empty($data['content']),//门店简介
                'is_main' => 0, //默认为0，代表的是分店的信息
                'xpoint' => empty($lnglat['result']['location']['lng']) ? '' : $lnglat['result']['location']['lng'], //经纬度
                'ypoint' => empty($lnglat['result']['location']['lat']) ? '' : $lnglat['result']['location']['lat']
            ];
            $locationId = model('BisLocation')->add($locationData);

            if ($locationId){
                $this->error('门店申请成功');
                return;
            }else{
                $this->success('门店申请失败');
            }
            //如果数据成功插入到数据库，就发封邮件告诉用户
//            $title = "o2o入住申请通知";
//            $url = request()->domain().url('bis/register/waiting',['id'=>$bisId]); //链接传入$bisId
//            $content = "您提交的入住申请需要平台方审核,您可以点击<a href='".$url."' target='_blank'>查看链接</a>获取审核状态";
//            \phpmailer\Email::send($data['email'],$title,$content);
//            //提示之后跳转
//            $this->success('o2o入住申请通知成功,请登录'.$data['email'].'查看!',url('register/waiting',['id'=>$bisId]));

        }
        $Category = model('Category')->getFirstCategory();
        $citys = model('City')->getNormalCityByParentId();
        return $this->fetch('', [
            'citys' => $citys,
            'Category' => $Category
        ]);
    }
    //个人列表页
    public  function  index(){
        //拿到session里面的bis_id
        $bis_sessionId = $this->getLoginUser()->bis_id;//现在已经是登录状态从session里面拿到bis_id(从继承的base类里面获取)
        $locationData = $this->obj->getLocationByStatus(0,$bis_sessionId);
        return $this->fetch('',[
            'bisLocationData'=>$locationData
        ]);
    }
    //分店详情
    public function  detail($id){
        $Category = model('Category')->getFirstCategory();
        $citys = model('City')->getNormalCityByParentId();
        //根据传入id获取整条信息
        $bisLocationData = $this->obj->get($id);
        return $this->fetch('', [
            'citys' => $citys,
            'Category' => $Category,
            'bisLocationData'=>$bisLocationData
        ]);
    }
    //改变状态status
    public function  status(){
        $data = input('get.');
        $res =  $this->obj->save(['status'=>$data['status']],['id'=>intval($data['id'])]);
        if ($res){
            $this->success('下架成功');
            return;
        }
        $this->success('下架失败');
    }

}