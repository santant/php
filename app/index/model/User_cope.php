<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/9/10
 * Time: 09:18
 */
namespace app\index\model;
use  think\Model;
use traits\model\SoftDelete; //引入软删除的方法
class UserCope extends Model{
    #命名  User需要和数据库里面的表对应

    #引入软删除
    use SoftDelete;

    #自动开启时间搓功能
    protected $autoWriteTimestamp = true;
    protected $createTime ='time_insert';  //配置插入和修改的数据库表字段
    protected $updateTime = 'time_update';

    #如果数据库的软删除字段不是delete_time也可以设置 protected $deleteTime = 'xxx'
    # protected $deleteTime = 'xxx'
}