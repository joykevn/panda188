<?php
//郑州人保派送项目登录界面
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller {
    
    public function index(){
        $this->display();
    }
    
    //退出登录
    public function login_out(){
        
        //cookie('psy_name', null);
        //cookie('psy_pwd', null);
        echo "hello"; 
        //$this->redirect(U('Login/index'));
    }
}

