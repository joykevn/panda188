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

    //调试页面
    public function test(){
        $this->display();
    }

    /***
     * 到zzpicc数据库info_baodan106数据表中查询该保单是否存在
     * 若存在，将该数据复制后，反馈给熊猫主页
     * 参数：获取$_GET 中的保单号
     *  */    
    public function return_info_ps(){
        $bdh_arr=$_GET; //获取保单号
        $Info_bd  = M('baodan106','info_','USED_DB');
        //保单号，保险人，车牌号，手机号，身份证号,车架号，保单生效日期，订单日期
        $field='insurno,insurname,licenseno,insurmobile,insuredidentinumber,frameno,startdate,appldate';//定义查询域
        foreach ($bdh_arr as $key => $value) {
            $map['insurno'] = $value;
            //$map['insurname'] = '马少民';
            $db_return_data=$Info_bd->Field($field)->where($map)->select();
            if($db_return_data){//有该保单号
                foreach ($db_return_data as $key => $bd_info) {
                    $bd_info['psyname']='';//派送员
                    $bd_info['psstatus']='待分配';//派送状态
                    $bd_info['otherinfo']='无备注';//备注项
                    $bd_info['pstime']='';//派送时间

                    $this->assign('list',$bd_info);//模板分配
                    $this->display();
                    //p($bd_info);

                }
                //p($db_return_data);
            }else{//无此保单号
                echo '保单号：';
                echo $value . '<br>';
                echo '找不到该保单，可能是尚未录入。';
            }
        }
        
        
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

