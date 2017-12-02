<?php
namespace app\admin\controller;
use think\Controller;
use app\index\model\UserCope;  //引入模型

class Category extends  Controller{
//
    private  $obj; //定义1个内部变量
    public  function  _initialize(){ //tp5自带的初始化函数，可以抽取一些公共的东西
        $this->obj = model('category'); //用变量负值
    }
    public function index()
    {
        //获取页面传递过来的参数,默认0，作用intval函数  并修改config里面的url_common_param为true
         $parent_id = input('get.parent_id',0,'intval');
        //获取一级栏目
        $categoryFirst = $this->obj->getFirstCategory($parent_id);
        return $this->fetch('index',[
            "categoryFirst"=>$categoryFirst
        ]);
    }
    //分类保存的方法
    public function  edit($id=0){ //默认id为0
        if (intval($id)<1){
            $this->error('参数不合法');
        }
        //得到传递的id，查询到他当前的记录内容
        $category = $this->obj->get($id);
        //得到分类数据
        $categorys =  $this->obj->getNormalFirstCategory();
        return $this->fetch('edit',[
            'categorys' =>$categorys,
            'category' =>$category
        ]);
    }
    //分类保存
    //  tp5获取数据的方式
    //print_r($_POST);
    //print_r(input('post.'));
    // print_r(request()->port());
    public  function  save(){
        print_r(input('post.'));
        $data = input('post.');
        //->scene('add') 传给场景设置的规则
        //验证表单 ->check
        $validate = validate('Category');
        if(!$validate->scene('add')->check($data)){//验证失败
            $this->error($validate->getError());
        }
        //如果有id过来就是保存,无就是增加
        if (!empty($data['id'])){ //id不为空
            return $this->obj->update($data);
        }
        //验证通过吧$data提交到model-save保存
        $res =  $this->obj->add($data);
        if ($res){
            $this->success('新增成功');
        }else{
            $this->error('新增失败');
        }
    }
    //分类添加的页面和方法
    public function add()
    {
        //得到分类数据
        $categorys =  $this->obj->getNormalFirstCategory();
        return $this->fetch('add',[
            'categorys' =>$categorys
        ]);
    }
    //更新分类数据
    public function update($data){
        //修改方法（修改内容,[修改的具体组件]）
        $res =  $this->obj->save($data,['id'=>intval($data['id'])]);
        if ($res){
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
    }

    //排序的逻辑
    public function  listorder($id,$listorder){
        //根据id修改listorder
        $res = $this->obj->save(['listorder'=>$listorder],['id'=>$id]);
        if ($res){
            $this->result($_SERVER['HTTP_REFERER'],1,'success');
        }else{
            $this->result($_SERVER['HTTP_REFERER'],0,'error');
        }
    }
    //修改状态 正常和待审核互换
    public function  status(){
//        print_r(input('get.'));
        $data = input('get.');
        //->scene('status') 传给场景设置的规则
        //验证表单 ->check
        $validate = validate('Category');
        if(!$validate->scene('status')->check($data)){//验证失败
            $this->error($validate->getError());
        }
        $res= $this->obj->save(['status'=>$data['status']],['id'=>$data['id']]);
        if ($res){
            $this->success('状态更新成功');
        }else{
            $this->error('状态更新失败');
        }

    }
}
