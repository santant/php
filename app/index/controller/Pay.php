<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/11/21
 * Time: 16:57
 */

namespace app\index\controller;

use think\Model;
class Pay extends  Model
{
    public function index(){
        echo  '支付的首页';
    }
}