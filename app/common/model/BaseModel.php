<?php
/**
 * BaseModel 公共的model
 */

namespace app\common\Model;

use  think\Model;
class BaseModel extends  Model
{
    protected $autoWriteTimestamp = true;
    //增加的方法
    public function add($data){
        $data['status'] = 0; //状态默认为0
//          $data['create_time'] = time();
        $this->save($data);
        return $this->id;  //保存，数据，返回组件id
    }
}