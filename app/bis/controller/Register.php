<?php
namespace app\bis\controller;

use  think\Controller;

class Register extends Controller
{
    public function index()
    {
        $Category = model('Category')->getFirstCategory();
        $citys = model('City')->getNormalCityByParentId();
        return $this->fetch('', [
            'citys' => $citys,
            'Category' => $Category
        ]);
    }

    public function add()
    {
        if (!request()->isPost()) { //如果不是post方式提交
            $this->error("请求错误");
        }
        //获取表单的值
        $data = input("post.");

        //检验数据
        $validate = validate('Bis');
        if (!$validate->scene('add')->check($data)){ //验证不通过
            $this->error($validate->getError());
        }
        //得到地图标注的点（经纬度）  继承extend里面的map类
//          print_r(\Map::getLngLat($data['address']));
        $lnglat = \Map::getLngLat($data['address']);
        if (empty($lnglat) || $lnglat['status'] != 0 || $lnglat['result']['precise'] != 1) {
            $this->error('无法获取数据，或获取的数据不精确');
        }
        //判断提交的用户名是否存在
        $accountResult = model('BisAccount')->get(['username'=>$data['username']]);
        if($accountResult){
            $this->error('该用户名已经存在,请重新输入');
        }
        //基本信息入库
        //商户基本信息
        $bisData = [
            'name' => $data['name'],
            'city_id' => $data['city_id'],
            'city_path' => empty($data['se_city_id']) ? $data['city_id'] : $data['city_id'] . ',' . $data['se_city_id'],
            'logo' => $data['logo'],
            'licence_logo' => $data['licence_logo'],
            'description' => empty($data['description']) ? '' : $data['description'],
            'bank_info' => empty($data['bank_info']) ? '' : $data['bank_info'],
            'bank_user' => empty($data['bank_user']) ? '' : $data['bank_user'],
            'bank_name' => empty($data['bank_name']) ? '' : $data['bank_name'],
            'faren' => empty($data['faren']) ? '' : $data['faren'],
            'email' => empty($data['email']) ? '' : $data['email'],
            'faren_tel' => empty($data['faren_tel']) ? '' : $data['faren_tel']
        ];
        $bisId = model('Bis')->add($bisData);
//        echo $bisId; exit;
//      总店的相关信息入库
        $locationData = [
            'bis_id' => $bisId, //总店相关信息需要关联商户基本信息id
            'tel' => $data['tel'],//电话
            'name' => $data['name'],//法人
            'logo' => $data['logo'],//法人
            'contact' => $data['contact'],//联系人
            'category_id' => $data['category_id'],//发布产品主分类
            'category_path' => $data['category_id'].','.$data['category_path'],//分类
            'city_id' => $data['city_id'],
            'city_path' => empty($data['se_city_id']) ? $data['city_id'] : $data['city_id'] . ',' . $data['se_city_id'],
            'address' => $data['address'],//地址
            'open_time' => $data['open_time'],//营业时间
            'content' => empty($data['content']) ? '' : empty($data['content']),//门店简介
            'is_main' => 1, //默认为1，代表的是总店的信息
            'xpoint' => empty($lnglat['result']['location']['lng']) ? '' : $lnglat['result']['location']['lng'], //经纬度
            'ypoint' => empty($lnglat['result']['location']['lat']) ? '' : $lnglat['result']['location']['lat']
        ];
        $locationId = model('BisLocation')->add($locationData);

        //账户相关的验证信息
        //商户账户相关用户信息入库
        $data['code'] = mt_rand(100,100000); //随机数
        $userData = [
            'bis_id' => $bisId, //用户需要关联商户基本信息id
            'username'=>$data['username'],
            'password'=>md5($data['password']),
            'code'=>$data['code'],
            'is_main'=>1 //代表的是总管理员
        ];
        $userDataId = model('BisAccount')->add($userData);
//        if (empty($userDataId) && empty($locationId) && empty($bisId)){
//            $this->success('数据添加成功');
//        }
        if (!$userDataId){
            $this->error('申请失败');
            return;
        }
        //如果数据成功插入到数据库，就发封邮件告诉用户
        $title = "o2o入住申请通知";
        $url = request()->domain().url('bis/register/waiting',['id'=>$bisId]); //链接传入$bisId
        $content = "您提交的入住申请需要平台方审核,您可以点击<a href='".$url."' target='_blank'>查看链接</a>获取审核状态";
        \phpmailer\Email::send($data['email'],$title,$content);
        //提示之后跳转
        $this->success('o2o入住申请通知成功,请登录'.$data['email'].'查看!',url('register/waiting',['id'=>$bisId]));
    }
    public function  waiting($id){
       //不存在id
        if (empty($id)){
            $this->error('error');
        }
        $detail = model('Bis')->get($id);
        //跳转到1个页面
        return $this->fetch('',[
            'detail'=>$detail
        ]);
    }
}
