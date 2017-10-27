<?php
namespace app\api\controller;

use  think\Controller;
use  think\Request; //引入Request
use  think\File;  //引入file
class Image extends Controller
{
    public function upload(){
       $file =  Request::instance()->file('file'); //得到file文件
        //给定(创建)一个目录
        $info = $file->move('upload');
        if ($info && $info->getPathname()){ //如果上传有值，并且上传的目录成功
            print_r('/'.$info->getPathname());
//         返回1成功,图片的路径,标识符
           show(1,'/'.$info->getPathname(),'success');
          return;
        }
        print_r('error');
    }
}