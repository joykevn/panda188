<?php
namespace MPhone\Controller;
use Think\Controller;
class PsyloginController extends Controller{
    public function index(){
        $this->display();
    }
    public function login(){
        //echo C('ERROR_PAGE');die();
        if(!IS_POST) E('页面不存在1');
    }

}

