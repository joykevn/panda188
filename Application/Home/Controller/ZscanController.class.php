<?php
//郑州保单派送，通过扫码枪分配web页面
namespace Home\Controller;
use Think\Controller;

class ZscanController extends Controller {

    //首页
    public function index(){
        
        //echo "zzpe";
        $this->display();
    }
    //测试函数
    public function new_file(){
        $this->display();
    }
    
    
    
/* ************************************************************************
 * 数据库接口区
*************************************************************************** */
    //核对派送员编号，并根据派送员编号，查看今日该派送员订单情况。
    public function psy_check(){

    }
    
    
    //订单扫描验证
    public function dd_check(){
        $m1  = M('zzps','tab_','DB_dlSAE');//基础数据库
        $m2  = M('zzps_status','tab_','DB_dlSAE');//派送状态库
        $m3  = M('users','tab_','DB_dlSAE');//派送员人名
        //$m1  = M('zzps','tab_','DB_LOCALHOST');
        //$m2  = M('zzps_status','tab_','DB_LOCALHOST');//派送状态库
        $data=$m1->where("dingdanhao='%s'",$_POST['dingdanhao'])->field('dingdanhao,chepaihao,shoujianren,sddizhi')->select();
        $psy_info=$m3->where("usercode='%s'",$_POST['psy_code'])->field('username,usercode')->select();
        if(sizeof($psy_info)){//派送员编码输入正确
<<<<<<< HEAD
=======
            
        }
        
        if(sizeof($data)){//有此订单          
            $tem_data['dingdanhao']=$data[0]['dingdanhao'];
            $tem_data['chepaihao']=$data[0]['chepaihao'];
            $tem_data['shoujianren']=$data[0]['shoujianren'];
            $tem_data['sddizhi']=$data[0]['sddizhi'];
            $tem_data['paisongyuan']="张三";
            $tem_data['paisongtime']= date('Y-m-d H:i:s',time());
            $tem_data['paisongstatus']="已分配，待派送";                     
       
            $result=$m2->add($tem_data);
            //异常处置待定
            if($result){
                //$this->ajaxReturn($result,'JSON');
            }else{
                //$this->ajaxReturn(0,'JSON');
            }
>>>>>>> 31174abb82d06eec34e93cfc749e3c993f6af8d3
            
            if(sizeof($data)){//有此订单
                $tem_data['dingdanhao']=$data[0]['dingdanhao'];
                $tem_data['chepaihao']=$data[0]['chepaihao'];
                $tem_data['shoujianren']=$data[0]['shoujianren'];
                $tem_data['sddizhi']=$data[0]['sddizhi'];
                $tem_data['paisongyuan']=$psy_info[0]['username'];
                $tem_data['paisongtime']= date('Y-m-d H:i:s',time());
                $tem_data['paisongstatus']="已分配，待派送";
                 
                $result=$m2->add($tem_data);
                //异常处置待定
                if($result){
                    //$this->ajaxReturn($result,'JSON');
                }else{
                    //$this->ajaxReturn(0,'JSON');
                }
            
                $this->ajaxReturn($data,'JSON');
            }else{//无此订单          
                $this->ajaxReturn("dingdan_less",'JSON');
            }
        }else{//无此派送员编码
            $this->ajaxReturn("psy_code_less",'JSON');
        }
        
        
    }
    //读取派送状态表tab_zzpsstatus，渲染派送表格
    public function rend_table_ps(){
        $m1  = M('zzps','tab_','DB_dlSAE');//基础数据库
        $m2  = M('zzps_status','tab_','DB_dlSAE');//派送状态库
        //$m1  = M('zzps','tab_','DB_LOCALHOST');
        //$m2  = M('zzps_status','tab_','DB_LOCALHOST');//派送状态库
        $data=$m2->field()->select();
        if(sizeof($data)){//该单已扫描，待派送          
            
            
            $dbArr['code']=0;
            $dbArr['msg']="";
            $dbArr['count']=sizeof($data);
            $dbArr['data']=$data;
       
            $this->ajaxReturn($dbArr,'JSON');
        }else{//数据库tab_zzpsstatus异常    
            $this->ajaxReturn(0,'JSON');
        }
    }
    //测试验证数据调用
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

}