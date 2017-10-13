<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/9/10
 * Time: 09:18
 */
namespace app\index\model;
use  think\Model;

class User extends Model{
    #命名  User需要和数据库里面的表对应

    #自动完成的字段操作(数据，新增和修改的时候完成)
    protected  $auto = [ // $auto 操作的时候就会改变的字段数组
      'time'
    ];

    protected $insert = [ //$insert 只有在字段新增的时候会修改
        'time_insert'
    ];

    protected $update = [ //数据更新的时候会改变的字段
        'time_update'
    ];
    #获取数据库里面的属性名称返回做最后的操作
    public  function  getSexAttr($val){
        if($val=='0'){
            return "男";
        }
        if($val=='1'){
            return "女";
        }
        if($val=='2'){
            return "未知";
        }
    }
    public  function  getNumAttr($val){
        if($val==100){
            return "名称11";
        }
    }

    #设置数据库里面的属性名称返回做最后的操作 $val 设置影响的值 $data,那一条数据的整个数组
    public  function  setPasswordAttr($val,$data){
        if($val){ //给添加的password字段添加md5加密
            dump($data['sex']);
            return md5($val);
        }
    }
    #自动完成的字段time
    public function  setTimeAttr($val){ //添加时候自动添加插入时间
        return time();
    }
    #字段新增的时候修改time_insert
    public  function  setTimeInsertAttr($val){
        return time();
    }

    #修改的时候修改
    public  function  setTimeUpdateAttr($val){
        return time();
    }
}