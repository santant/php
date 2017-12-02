<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/11/14
 * Time: 16:03
 */

namespace app\index\controller;
class Order extends  Base
{
    /**
     * 订单
     */
    public  function  index(){
     if (!$this->getLoginUser()){
         $this->error('请登陆','user/login');
     }
    $id = input('get.id');
    //查询当前商品信息
    $detail = model('Deal')->get($id);
     return $this->fetch('',[
         'detail'=>$detail
     ]);
    }
    public function  create() //创建订单
    {
        if (!$this->getLoginUser()){
            $this->error('请登陆','user/login');
        }
        $id = input('get.id',0,'intval');
        $dealCount = input('get.deal_count',0,'intval'); //数量
        $dealPrice = input('get.total_price',0,'intval');//金额
//        dump(empty($_SERVER['HTTP_REFERER']));
        //首先拿id去检查商品是否存在
        $detail = model('Deal')->find($id);
        if (!$detail || $detail->status != 1) {
            $this->error('商品不存在');
        }
        if (empty($_SERVER['HTTP_REFERER'])){ //判断链接来源是否合法
            $this->error('请求不合法');
        }
        //生成订单号的方法 setOrderSn 在common里面
        $orderSn = setOrderSn();
        //组装入库数据
        $user = $this->getLoginUser(); //得到用户信息
        $data_order = [
            'out_trade_no' => $orderSn,
            'user_id'=>$user->id,
            'username'=>$user->username,
            'deal_id'=>$id,
            'deal_count'=>$dealCount,
            'total_price'=>$dealPrice,
            'referer'=>$_SERVER['HTTP_REFERER']
        ];
//        $orderId = model('Order')->add($data_order);
        try{
            $orderId = model('Order')->add($data_order);
        } catch (\Exception $e){
            $this->error('订单创建失败');
        }
        echo $orderId;
//        $this->redirect('pay/index',['id'=>$orderSn]);
    }
}