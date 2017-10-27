<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/10/18
 * Time: 14:29
 */

namespace app\api\controller;

use  think\Controller;
class Category extends  Controller
{
    private  $obj;
    public function _initialize(){
        $this->obj = model('Category');
    }
    //根据一级分类返回他底下的二级分类
    public  function  getCategoryByParentId(){
        $category =  $this->obj->getFirstCategory(input('post.id'));
        //调用common.php里面show自定义返回的方法
        if (!$category){
            return show(0,$category,'error');
        }
        return show(1,$category,'success');
    }
}