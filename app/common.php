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
