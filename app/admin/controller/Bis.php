<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/10/26
 * Time: 14:50
 */

namespace app\admin\controller;

use think\Controller;
use app\index\model\UserCope;  //引入模型
class Bis extends  Controller
{
    private  $obj;
    public function  _initialize(){
        $this->obj = model('Bis');
    }

    /**
     * 商家正常的列表（就是审核通过的列表）
     */
    public  function  index(){
        $bisData = $this->obj->getBisByStatus(1);
        return $this->fetch('',[
            'bisData'=>$bisData
        ]);
    }
    /**
     * 商家被删除的列表
     */
    public  function  delect(){
        $bisData = $this->obj->getBisByStatus(-1);
        return $this->fetch('dellist',[
            'bisData'=>$bisData
        ]);
    }
    /**
     * 商家入住申请列表不包含被删除的
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

//        echo request()->domain().request()->root();
        $Host = request()->domain().request()->root();
        //拿到三张表的数据填充到表单
        return $this->fetch('', [
            'citys' => $citys,
            'Category' => $Category,
            'BisData'=>$BisData,
            'locationData'=>$locationData,
            'accountData' =>$accountData,
            'HOST' => $Host
        ]);
    }

    /**
     * @param $status 修改商户状态
     */
    public function status(){
        //修改方法（修改内容,[修改的具体组件]）
        $data = input('get.');
//        print_r($data);
        $res =  $this->obj->save(['status'=>$data['status']],['id'=>intval($data['id'])]);
        $bisLocation =  model('BisLocation')->save(['status'=>$data['status']],['bis_id'=>intval($data['id'])],['is_main'=>1]);
        $bisAccount =  model('BisAccount')->save(['status'=>$data['status']],['bis_id'=>intval($data['id'])],['is_main'=>1]);
        if ($res && $bisLocation && $bisAccount){
            \phpmailer\Email::send('827879040@qq.com','020_商户审核通知','审核通过...恭喜您');
            $this->success('状态更新成功');
            //不管商户能不能通过审核都需要给用户发送邮件
        }else{
            \phpmailer\Email::send('827879040@qq.com','020_商户审核通知','不好意思审核没有通过，请您上传更详细的资料验证');
            $this->error('状态更新失败');
        }
    }
}