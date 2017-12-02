<?php
namespace app\index\controller;
class Index extends  Base {
    public function index()
    {
        //查询团购商品列表
        $Host = request()->domain().request()->root();
        $DealData = model('Deal')->getDataByCityId(4,$this->city->id);
        print_r(request()->domain().request()->url());
        return $this->fetch('index',[
            'DealData'=>$DealData,
            'HOST'=>$Host
        ]);
    }
}
