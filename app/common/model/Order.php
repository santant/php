<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/11/6
 * Time: 09:56
 */

namespace app\common\model;

use think\Model;

class Order extends Model
{
    protected $autoWriteTimestamp = true;
    public function add($data)
    {
        $data['status'] = 1; //状态默认为0
//       $data['create_time'] = time();
        $this->save($data);
        return $this->id;  //保存，数据，返回组件id
    }
}