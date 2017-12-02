<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/11/1
 * Time: 15:13
 */

namespace app\admin\controller;

use think\Controller;
class Location extends  Controller
{
    //管理员门店管理list
    public function  index(){
//        $bis_sessionId = $this->getLoginUser()->bis_id;//现在已经是登录状态从session里面拿到bis_id(从继承的base类里面获取)
        $bisLocationData = model('bisLocation')->getLocationByfendian(0,0);
        return $this->fetch('',[
            'bisLocationData'=>$bisLocationData
        ]);
    }
    //查看分店详情
    public function  detail($id){
        $Category = model('Category')->getFirstCategory();
        $citys = model('City')->getNormalCityByParentId();
        //根据传入id获取整条信息
        $bisLocationData = model('bisLocation')->get($id);
        return $this->fetch('', [
            'citys' => $citys,
            'Category' => $Category,
            'bisLocationData'=>$bisLocationData
        ]);
    }
    /**
     * @param $status 修改审核状态0 1 2 -1
     */
    public  function  status($status){
        $data = input('get.');
        $res =  model('bisLocation')->save(['status'=>$data['status']],['id'=>intval($data['id'])]);
        if ($res){
            $this->success('修改成功');
            return;
        }
        $this->success('修改失败');
    }
}