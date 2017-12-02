<?php
namespace app\admin\validate;
use think\Validate;
class Category extends Validate {
    protected  $rule = [


        ['name', 'require|max:10', '分类名必须传递|分类名不能超过10个字符'],
        ['parent_id','number','状态必须是数字'],
        ['id', 'number'],
        ['status', 'number|in:-1,0,1','状态必须是数字|状态范围不合法'],
        ['listorder', 'number']
    ];

    /**场景设置**/
    protected  $scene = [
        'add' => ['name', 'parent_id', 'id'],// 添加的功能只有数组里面的字段有用
        'listorder' => ['id', 'listorder'], //排序的功能只有数组里面的字段有用
        'status' => ['id', 'status'], //状态验证
    ];
}