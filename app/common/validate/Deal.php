<?php
namespace app\common\validate;
use think\Validate;
//bis公共的验证模块儿
class Deal extends Validate {
    protected  $rule = [
        ['name', 'require|max:25', '团购名称必须传递|分类名不能超过25个字符'],
        ['email','require|email','邮箱必须填写'],
        ['city_id','number','城市必须选择'],
        ['se_city_id','number','城市下级必须选择'],
        ['start_time','require','团购开始时间必须填写'],
        ['end_time','require','团购结束时间必须填写'],
        ['image', 'require','logo必须传递'],
        ['location_ids','require','门店必须传递']
//        ['licence_logo', 'require'],
//        ['username','require|max:25','用户名必须填写|用户名不能超过25个字符'],
//        ['password','require|max:25|min:6','密码必须填写|密码不能超过25个字符|密码必须超出6个字符'],
//        ['status', 'number|in:-1,0,1','状态必须是数字|状态范围不合法']

    ];
    /**场景设置**/
    protected  $scene = [
        'add' => ['name', 'start_time', 'end_time','city_id','se_city_id','image','location_ids'],// 添加的功能只有数组里面的字段有用
//        'listorder' => ['id', 'listorder'], //排序的功能只有数组里面的字段有用
//        'status' => ['id', 'status'], //状态验证
    ];
}