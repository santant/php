<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/11/7
 * Time: 13:55
 */

namespace app\common\model;

namespace app\common\model;

use think\model;
class Featured extends BaseModel{

    //查询推荐位的内容
    public  function  slectType($type){
        $data = [
          'status'=>  ['neq',-1],
           'type'=> $type
        ];
        return $this->where($data)->paginate();
    }

    public  function  slectTypeData($type,$limit=5){
        $data = [
            'status'=>  ['neq',-1],
            'type'=> $type
        ];
        $order = [
            'listorder'=>'desc',
            'id'=>'desc'
        ];
        return $this->where($data)->limit($limit)->select();
    }
}