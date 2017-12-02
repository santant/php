<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/11/8
 * Time: 15:58
 */

namespace app\index\controller;

use think\Controller;
use think\Session;
use think\model;

class Base extends Controller
{

    public $city = ''; //默认选择城市的数据
    public $account = '';//用户信息数据
    public function _initialize()
    {
//        $o2o_user = session('o2o_user', '', 'o2o');
        //获取首页推荐分类
        $cats = $this->getRecommendCats();
        //获取城市列表
        $citys = model('City')->getNormalCityByParentId();
        $this->getCity($citys);
        $this->getLoginUser();//获取用户列表
        //获取首页中心广告类
        $bannerCenter = $this->getBannerCenter(0);
        $bannerRight = $this->getBannerCenter(1);
        //传递数据到模版到另外一种方式 $citys
        $this->assign('citys', $citys);//城市列表
        $this->assign('city', $this->city); //默认城市
        $this->assign('user', $this->account); //用户信息
        $this->assign('cats', $cats); //
        $this->assign('bannerCenter', $bannerCenter); //首页中心广告图
        $this->assign('bannerRight', $bannerRight); //首页中心广告图
        $this->assign('HOST', $Host = request()->domain().request()->root()); //Host
//        把控制器给动态传递下去
        $this->assign('controller', strtolower(request()->controller())); //Host
        $this->assign('title', '020团购网'); //Host

//        print_r(request()->baseUrl());
    }
    //传递城市获取或者切换当前城市所对应的数据
    public function getCity($citys)
    {
        foreach ($citys as $city) {
            $city = $city->toArray();
            if ($city['is_default'] == 1) { //如果是默认
                $defaultName = $city['uname'];
                break;//跳出for循环
            }
        }
        $defaultName = $defaultName ? $defaultName : 'beijing';
        //拿到默认的uname存入session
        $cityname = input('get.city', $defaultName, 'trim'); //如果链接没有的就有1个默认的，如果有就city那个url
        session('cityname', $cityname, 'o2o');
        //拿到当前城市的数据返回模版
        $this->city = model('City')->getNameByUname($cityname);
    }

    //获取用户名
    public function getLoginUser(){
        if (!$this->account){
            $this->account = session('o2o_user', '', 'o2o');
        }
        return  $this->account;
    }
    //获取首页分类功能
    public function  getRecommendCats(){
        $parentIds = $sedcatArr = $recomCats = [];
        $cats = model('Category')->getNormalCategoryByParentId(0,5);
        foreach($cats as $cat) {
            $parentIds[] = $cat->id;  //把一级栏目的索引id放入$parentIds这个数组
        }
        // 传递数组id索引获取所有的二级栏目
        $sedCats = model('Category')->getNormalCategoryByParentIdToData($parentIds);

        foreach($sedCats as $sedcat) {
            $sedcatArr[$sedcat->parent_id][] = [
                'id' => $sedcat->id,
                'name' => $sedcat->name,
            ];
        }

        foreach($cats as $cat) {
            // recomCats 代表是一级 和 二级数据，  []第一个参数是 一级分类的name, 第二个参数 是 此一级分类下面的所有二级分类数据
            $recomCats[$cat->id] = [$cat->name, empty($sedcatArr[$cat->id]) ? [] : $sedcatArr[$cat->id]];
        }
        return $recomCats;
    }
    //首页中心banner图
    public function  getBannerCenter($type){
       return model("Featured")->slectTypeData($type,5);
    }
}