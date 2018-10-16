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
    public function readxml(){
        //XML标签配置
        $xmlTag = array(
            '@1'=>'starttime',
            '@2'=>'endtime',
            '@3'=>'school'
        );
        

        $dingdan_temp_arr = array();
        $xml = simplexml_load_file('./other/test3.xml');
        // foreach($xml->children() as $period) {
        //     $study[] = get_object_vars($period);//获取对象全部属性，返回数组
        // }
        // echo '<pre>';
        // p($study[0][contactname]->attributes());
        // echo "-----------------------------------";
        // p($study[0]);
        $count=1;
        $Info_bd  = M('baodan','info_','USED_DB');
        foreach($xml->children() as $DataRecord){
            $i=1;
            //echo "<h2>" . $count++ . '_____________________________________________</h2>';
            //$dingdan_temp_arr['id']=$count++;
            foreach ($DataRecord as $obj) {
                echo $i++ . "：";
                //echo $obj->getName() . ">>>>";
                $key=(string)$obj->getName();
                echo $obj->attributes()->_v;
                $dingdan_temp_arr[$key]=(string)$obj->attributes()->_v;
                echo "<br>";
            }
            p($dingdan_temp_arr);
            $Info_bd->data($dingdan_temp_arr)->add();
            
        }
    }
}
