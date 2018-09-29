<?php
namespace Home\Controller;
use Think\Controller;

class TestController extends Controller {
    public function index(){
        $this->display();
        //$this->success('操作完成',__ROOT__.'/Test/show',3);
    }
    public function show(){
        if(!IS_POST) _404("页面不存在");
        //echo "111";
        $data=array(
            'username'=>I('username','','htmlspecialchars'),
            'pwd'=>I('pwd','','htmlspecialchars'),
            'time'=>time()
        );
        p($data);
        p($_POST);
        $this->error('插入失败，请重试……');
    }
    
}