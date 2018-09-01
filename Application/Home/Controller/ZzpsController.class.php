<?php
//郑州保单配送项目
namespace Home\Controller;
use Think\Controller;

class ZzpsController extends Controller {

    //首页
    public function index(){
        
        //echo "zzpe";
        $this->display();
    }
    //打印所有订单
    public function printdd(){
        $m  = M('zzps','tab_','DB_dlSAE');
        //$m  = M('zzps','tab_','DB_LOCALHOST');
        $data=$m->field('ID,dingdanhao,chepaihao,shoujianren')->select();
        if(sizeof($data)){//有查询结果 而且是商业险
            $returndata='{"code":0,"msg":"","count":1000,"data":'.$data.'}';
            $dbArr['code']=0;
            $dbArr['msg']="";
            $dbArr['count']=sizeof($data);
            $dbArr['data']=$data;
            $this->ajaxReturn($dbArr,'JSON');
        }else{//无商业险查询结果
            $this->ajaxReturn(0,'JSON');
        }
    }    
    //扫描条形码
    public function scan(){
        $this->display();
    }
}

