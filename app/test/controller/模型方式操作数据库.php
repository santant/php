<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\UserCope;  //引入模型
use think\Db;  //引入数据库db类

class Index extends  Controller{
    public function index()
    {
      ##引入模型
        #1:直接引入use app\index\model\User;     User::get(7)>toArray() 可直接获取数据
//        $res = User::get(7);
//        $res = $res->toArray();
        #2:可以new 一个对象
//        $user = new User;
//        $res = $user::get(7)->toArray();
        #3:可以直接用助手函数model来完成(这个方法可以不引入use app\index\model\User;)
//        $user = model("User");
//        $res = $user::get(7)->toArray();

      ##在模型中使用数据库查询
//        $res = User::get(7);
//        #$res是一个对象
//        $username = $res->username; #对象->数据库字段，可以得到一个具体的字段
//        dump($username);
         #第二种查询 可以跟一个函数
//        $res = User::get(function ($query){
//           $query->where("username","eq","t1t")
//           ;
//        });
        #直接有where方法
//        $res = User::where("id",12)  //条件过滤
//                ->field("id,username")  //只查询那些字段
//                ->find()
//        ;

        #获取多条数据的方式 User::all("10,11,12") 直接跟上组件
//        $res = User::all("10,11,12");

        #where方式查询多条数据 注意是select不是单条的find方法
//        $res = User::where("id",">","10")  //条件过滤
//                ->field("id,username")  //只查询那些字段
//                ->select()
//            ;
//        //多条的数据需要便利
//        foreach ($res as $val){
//            dump($val->toArray());
//        }

        #模型的数据更新 可以直接跟上组件进行修改
//        $res =  User::update([
//           'id'=>10,
//            'username'=>'更新的数据'
//        ]);

        #可以直接在第二个数组里面传递过滤的条件
//        $res =  User::update(
//            [
//            'username'=>'更新的数据'
//            ],
//            ['id'=>11]
//        );

        #前面2种方法没法返回作用的行数,这个方法可以返回更新的影响条数，推荐
//        $res = User::where("id",">",15)
//           ->update([
//               'username'=>'修改的数据'
//           ])
//        ;
        #利用模型对象改变
//        $userModel = User::get(12); //组件id12
//        $userModel->username='123';
//        $userModel->email='123@qq.com';
//
//        $res = $userModel->save(); //可以返回更新条数

        $userModel = new UserCope;
        #批量添加
//        $res = $userModel->saveAll([
//           ['id'=>'10','username'=>'10'],
//            ['id'=>'11','username'=>'11']
//
//        ]);

//        dump($res);


        ##模型的数据删除
        #直接用组件删除
//        $res = User::destroy(6);

        #用模型的方法删除
//        $userModel = User::get(7);
//        $res = $userModel->delete();
//         dump($res);

        #用where条件的方式删除
        $res = UserCope::where("id",8)
            ->delete();
        dump($res);
    }
}
