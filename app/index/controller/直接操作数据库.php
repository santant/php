<?php
namespace app\index\controller;

use app\common\controller\user;
use think\Controller;

//use  think\config;
use think\Db;

class Index extends Controller
{
    public function index()
    {
//        dump(config('database'));
//        dump(Db::connect());
        #查询
        $date = Db::query('select * from user');
        #插入
//        $date1 = Db::execute('insert into user (id, username,password,email) values (?, ?,?,?)',[2,'sun','123','2322']);
//        dump($date);
        # Db::table  ->select返回的是一个二维数组
        #$res =  Db::table('user')->where(["id"=>"1"])->select();

        #Db::table  ->find 返回一个一纬数组
        #$res =  Db::table('user')->where(["id"=>"2"])->find();

        #Db::table  ->value  只返回1个结果的某个值
        #$res =  Db::table('user')->value("username");

        #Db::table  ->column  返回1个一维数组的那一列，数据库所有那一列的字段
        #$res =  Db::table('user')->column("username");

        #Db::user 和table类似

        #db 助手类 和前面的方式类似
        #$res = db('user',[],false)->select();

        #------------数据库添加  #插入
        $db = db::name('user');

        #insert 插入记录的条数
//        $db->insert([
//            'email' =>'pj@qq.com',
//            'username'=>'t11212121est',
//            'password'=>md5('112112234')
//        ]);

        #$db->insertGetId 插入并返回id
//        $res = $db->insertGetId([
//            'email' =>'pj@qq.com',
//            'username'=>'t1t',
//            'password'=>md5('112112234')
//        ]);


        #$db->insertAll 插入多条
//        $data = [];
//        for ($i=0;$i<10;$i++){
//            $data[] = [
//               'email' =>"pj@qq.com${i}",
//               'username'=>"彭进${i}",
//               'password'=>md5('112112234')
//           ];
//        }
//        $res = $db->insertAll($data);

        #数据的更新 $db-> update //必须有where条件
//        $res = $db->where([
//            'id' =>2
//        ])->update([
//            'username'=>'自改的'
//        ]);
        #setField 数据库跟新 每次只更新一个字段
//        $res = $db->where([
//            'id' =>5
//        ])->setField('username','自改的');

        #$db->setInc 自增
        #$db->setDec 自减


        #数据库删除
//        $res = $db->where([
//            'id'=>'2'
//        ])->delete();
        #可以直接在delect里面跟上组件，就不用where条件删除
        #$res = $db->delete(5);


        #buildSql 是把语句变成sql
        #数据库条件构造器 where   # ->where('id','>','10')  id>10
        #备注EQ =
        #NEQ <> 不等于
        #LT <
        #GT >
        #EGT >=
        #BETWEEN 1,5     1到5包含1,5
        #NOTBETWEEN1,5   除1-5的
        #IN
        #NOTTIN NOT IN (*,*)
        #where  如果两个条件是and的关系就在数据里面继续跟着就行 也可以是继续添加->where 方法来构造条件
//        $res = $db->where([
//            'id'=>'1',
//            'username'=>'张三'
//        ])->select();

        #数据库链式操作
        $res = Db::table('user')
            ->where("id", ">", 5)//id >5的数据
            ->field("username", "id")//只从数据库取这2个字段
            ->order("id DESC")//按照id倒叙排序
//            ->limit(3)  //返回多少条  ->limit(3,5) 从第三条开始取，返回5条
            ->page(1, 5)//page就是分页,选第一页，选5条   limit((3-1)*5,5) 分页的原理

            ->select();

        dump($res);
    }
}
