<?php
namespace app\common\validate;
use think\Validate;
//bis公共的验证模块儿
class Bis extends Validate {
    protected  $rule = [
        ['name', 'require|max:25', '商户名称必须传递|分类名不能超过25个字符'],
        ['email','require|email','邮箱必须填写'],
        ['city_id','number','请选择所在的地点'],
        ['se_city_id','number','请选择所在的地点下级'],
        ['address','require','地址必须填写'],
        ['logo', 'require','logo必须传递'],
//        ['licence_logo', 'require'],
        ['username','require|max:25','用户名必须填写|用户名不能超过25个字符'],
        ['password','require|max:25|min:6','密码必须填写|密码不能超过25个字符|密码必须超出6个字符'],
        ['status', 'number|in:-1,0,1','状态必须是数字|状态范围不合法']


//        [   name] =>
//            [city_id] => 0
//            [se_city_id] => 0
//            [logo] =>
//            [licence_logo] =>
//            [bank_info] =>
//            [bank_name] =>
//            [bank_user] =>
//            [faren] =>
//            [faren_tel] =>
//            [email] =>
//            [tel] =>
//            [contact] =>
//            [category_id] => 0
//            [address] =>
//            [open_time] =>
//            [username] => assaas
//            [password] =>
    ];
    /**场景设置**/
    protected  $scene = [
        'add' => ['name', 'email', 'city_id','se_city_id','logo','username','password','address'],// 添加的功能只有数组里面的字段有用
        'listorder' => ['id', 'listorder'], //排序的功能只有数组里面的字段有用
        'status' => ['id', 'status'], //状态验证
    ];
}