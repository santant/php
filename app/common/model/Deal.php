<?php
/**
 * Created by PhpStorm.
 * User: MAC
 * Date: 2017/11/6
 * Time: 09:56
 */

namespace app\common\model;

use think\model;

class Deal extends BaseModel
{
    public function getDealDataByBisId($bis_id, $status = 0)
    {

        if ($status == 0) { //默认的时候不显示删除的部分
            $data = [ //status 不等于-1
                'status' => ['neq', -1],
                'bis_id' => $bis_id,
            ];
        } else {
            $data = [
                'status' => $status,
                'bis_id' => $bis_id,
            ];
        }
        $order = [
            'id' => 'desc'
        ];
        return $this->where($data)
            ->order($order)
            ->paginate(); //分页
    }

    //分页模糊查询，搜索功能的查询
    public function getNormalDeals($data = [])
    {
        $data['status'] = ['neq', -1];
        $order = ['id' => 'desc'];
        $result = $this->where($data)
            ->order($order)
            ->paginate(2);
//        echo $this->getLastSql();
        return $result;
    }
    //根据默认城市id查询他所在城市所在分类

    /**
     * @param $id 栏目id
     * @param $city_id 城市id
     * @param int $limit 条数
     * @return \think\Paginator
     */
    public function getDataByCityId($id,$city_id,$limit=10)
    {
        $data = [
            'end_time'=>['gt',time()],
            'category_id'=>$id,
            'status' => 1,
            'city_id'=>$city_id
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
        ];
        $result =  $this->where($data)
            ->order($order);
        if ($result){
            $result = $result->limit($limit);
        }
        return $result->select();
    }
}