<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
//类似于vue里面的过滤器，就是显示到页面之后的后续操作
// 应用公共文件
function status($status){
    if ($status ==1){
        $str="<span class='label label-success radius'>正常</span>";
    }elseif ($status ==0){
        $str="<span class='label label-danger radius'>待审核</span>";
    }elseif ($status ==-1){
        $str="<span class='label label-danger radius'>删除</span>";
    }
    return $str;
}
/**
 * @param $status 状态
 */
function bisStatus($status){
    if ($status ==1){
        $str="<span class='label label-success radius'>正常</span>";
    }elseif ($status ==0){
        $str="<span class='label label-danger radius'>待审核</span>";
    }elseif ($status ==2){
        $str="<span class='label label-danger radius'>失败</span>";
    }elseif ($status ==-1){
        $str="<span class='label label-danger radius'>已删除</span>";
    }
    return $str;
}
/**
 * 商户入住申请状态
 * @param $status
 * @return string
 */
function bisRegister($status){
    if ($status ==1){
        $str="入住申请成功!";
    }elseif ($status ==0){
        $str="待审核,审核通过后平台后发送邮件通知，请关注!";
    }elseif ($status ==2){
        $str="非常抱歉，您提交到材料不符合条件，请重新提交";
    }
    return $str;
}

/** //给接口变成josn返回到客户端
 * @param $url
 * @param int $type $type=0 get   $type=1 post
 * @param array $data
 */
function doCurl($url,$type=0,$data=[]){
    $ch = curl_init();//初始化
    //设置选项，包括URL
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_HEADER, 0);

   //$type=1 post
   if ($type ==1){
       // post数据
       curl_setopt($ch, CURLOPT_POST, 1);
       // post的变量
       curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
   }
   //执行并获取内容
   $output =  curl_exec($ch);
    //释放curl句柄
    curl_close($ch);
    return $output;
}

/**
 * php通用的分页样式
 * @param $obj
 */
function pagination($obj){
    if (!$obj){
        return '';
    }
    return '<div class="cl pd-5 bg-1 bk-gray mt-20 o2o_page">'.$obj->render().'</div>';
}

/**
 * @param $city_path 地址回显第二级
 */
function getSeCityName($city_path){
    if (empty($city_path)){
        return '';
    }
    if (preg_match('/,/',$city_path)){ //判断是否有,字符串中
        $cityPath = explode(',',$city_path);
        $cityId = $cityPath[1];
    }else{ //没有,号
        $cityId = $city_path;
    }
    //拿到id之后查询他下面的字段返回
    $city = model('City')->get($cityId);
    echo $city->name;
}

/**
 *  //栏目回显
 */
function getCategoryName($category_path){
    //拿到id之后查询他下面的字段返回
    $category_path = model('Category')->get($category_path);
    echo $category_path->name;
}
/**
 * @param $timeNumber 时间搓转换
 */
function setTime($timeNumber){
    return date("Y-m-d H:i:s",$timeNumber);
}

//
function countLocation($ids){
    if (preg_match('/,/',$ids)){ //判断是否有,字符串中
        $cityPath = explode(',',$ids);
        return count($cityPath);
    }else{
        return count($ids);
    }
}
//设置订单号
function setOrderSn(){
    list($t1,$t2) = explode(' ',microtime());
    $t3 = explode('.',$t1*10000);
    return $t2.$t3[0].(rand(10000,999999));
}