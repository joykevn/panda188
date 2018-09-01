<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
    //首页
    public function index(){
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        //echo "ThinkPHP,1";

        $this->display();
    }
    //客户查询页面
    public function guester(){
        $this->display();
    }
    //派送员页面
    public function deliverer(){
        $this->display();
    }
    //客户填写页面
    public function guestinfo(){
        $this->display();
    }
    //支付页面
    public function pay(){
        $this->display();
    }
    
    //试验页面
    public function test(){
        $zkcz=0;
        switch ($zkcz)
        {
            case $zkcz<-0.1:
                echo "<0";   
                break;
            case 0:
            case 1:
                echo "0-1";
                break;
            case 115:
            case 116:
                echo "115-116";       
                break;
        }
    }
    
    //返回保单查询结果
    public function getmyjson(){
        //ajaxReturn(数据,‘提示信息’,状态)
        //$m  = M('baodan','tab_','DB_LOCALHOST');
        $m  = M('baodan','tab_','DB_SAE');
        $data=$m->where("chepaihao='%s'and baodanhao4='%s' and baodanleixing='商业险'",$_GET[chepaihao],$_GET[baodanhao4])->field('toubaoren,beibaoren,baodanhao,baodanhao4,toubaodanhao,baodanleixing,shijibaofei,chechuanshui,biaozhunbaofei,dailibianhao')->select();
        if(sizeof($data)){//有查询结果 而且是商业险
            $this->ajaxReturn($data,'JSON');
        }else{//无商业险查询结果
//             $data=$m->where("chepaihao='%s'",$_GET[chepaihao])->field('toubaoren,beibaoren,baodanhao,toubaodanhao,baodanleixing')->select();
//             if(sizeof($data)){//查找到其他险种
//                 $this->ajaxReturn($data,'JSON');
//             }else{//既无商业险，也无其他险
//                 $this->ajaxReturn(0,'JSON');
//             }
            $this->ajaxReturn(0,'JSON');
        }
//         if(1){
//             $this->ajaxReturn(json_encode($data),'添加信息成功',1);
//             //var_dump($data);
//             //echo json_encode($data);
//         }else{
//             $this->ajaxReturn(0,'添加信息失败',0);
//             echo "failed";
//         }
    }
    //输入收缴保费金额
    public function putbaofei(){     
        //$m  = M('baofei','tab_','DB_LOCALHOST');
        $m  = M('baofei','tab_','DB_SAE');
        $baodanTab= M('baodan','tab_','DB_SAE');
        $m->where("chepaihao='%s'",$_GET[chepaihao])->delete();//删除所有已有数据
        $jine_get=$_GET[peisongyuanbianma];
        $jine_db=$baodanTab->where("toubaodanhao='%s'",$_GET[toubaodanhao])->field("biaozhunbaofei")->select();
        $tempArr=$_GET+Array('chushishijian' =>date('Y-m-d H:i:s',time()));
        $zkcz=$jine_get-((string)round($jine_db[0]["biaozhunbaofei"]));
        switch ($zkcz)
        {
            case $zkcz<0:
                $tempArr=$tempArr+Array('bianmaflag' =>1);
                $tempArr=$tempArr+Array('zhekouchazhi'=>$zkcz);   
                break;
            case 0:
            case 1:
                $tempArr=$tempArr+Array('bianmaflag' =>1);
                $tempArr=$tempArr+Array('zhekouchazhi'=>$zkcz);       
                break;
            case 115:
            case 116:
                $tempArr=$tempArr+Array('bianmaflag' =>1);
                $tempArr=$tempArr+Array('zhekouchazhi'=>$zkcz);       
                break;
            case 120:
            case 121:
                $tempArr=$tempArr+Array('bianmaflag' =>1);
                $tempArr=$tempArr+Array('zhekouchazhi'=>$zkcz);                    
                break;
            case 124: 
            case 125:                
                $tempArr=$tempArr+Array('bianmaflag' =>1);
                $tempArr=$tempArr+Array('zhekouchazhi'=>$zkcz);                  
                break;
            case 132:   
            case 133:
                $tempArr=$tempArr+Array('bianmaflag' =>1);
                $tempArr=$tempArr+Array('zhekouchazhi'=>$zkcz);                
                break;
            case 161:
            case 162:                
                $tempArr=$tempArr+Array('bianmaflag' =>1);
                $tempArr=$tempArr+Array('zhekouchazhi'=>$zkcz);               
                break;
            case 173:
            case 174:                
                $tempArr=$tempArr+Array('bianmaflag' =>1);
                $tempArr=$tempArr+Array('zhekouchazhi'=>$zkcz);               
                break;
            case 242: 
            case 243:
                $tempArr=$tempArr+Array('bianmaflag' =>1);
                $tempArr=$tempArr+Array('zhekouchazhi'=>$zkcz);            
                break;                
            case 264:
            case 265:
                $tempArr=$tempArr+Array('bianmaflag' =>1);
                $tempArr=$tempArr+Array('zhekouchazhi'=>$zkcz);               
                break;             
            case 369:
            case 370:
                $tempArr=$tempArr+Array('bianmaflag' =>1);
                $tempArr=$tempArr+Array('zhekouchazhi'=>$zkcz);             
                break;
            default:
                //$tempArr=$tempArr+Array('bianmaflag' =>1);
                $tempArr=$tempArr+Array('zhekouchazhi'=>$zkcz);                    
        }
        
        //if($jine_get==((string)round($jine_db[0]["biaozhunbaofei"]))){//派送员填写的折扣费用（派送员编码）与计算折扣费用（标准保费）相等
        //    $tempArr=$tempArr+Array('bianmaflag' =>1);
        //}        
        //var_dump($tempArr);
        //die();
        $result=$m->add($tempArr);
        if($result){
            $this->ajaxReturn($result,'JSON');
        }else{
            $this->ajaxReturn(0,'JSON');
        }
    }
    //未计算差值
    public function putbaofei1(){     
        //$m  = M('baofei','tab_','DB_LOCALHOST');
        $m  = M('baofei','tab_','DB_SAE');
        $baodanTab= M('baodan','tab_','DB_SAE');
        $m->where("chepaihao='%s'",$_GET[chepaihao])->delete();//删除所有已有数据
        $jine_get=$_GET[peisongyuanbianma];
        $jine_db=$baodanTab->where("toubaodanhao='%s'",$_GET[toubaodanhao])->field("biaozhunbaofei")->select();
        $tempArr=$_GET+Array('chushishijian' =>date('Y-m-d H:i:s',time()));
        $zkcz=$jine_get-((string)round($jine_db[0]["biaozhunbaofei"]));
       
        
        if($jine_get==((string)round($jine_db[0]["biaozhunbaofei"]))){//派送员填写的折扣费用（派送员编码）与计算折扣费用（标准保费）相等
            $tempArr=$tempArr+Array('bianmaflag' =>1);
        }        
        //var_dump($tempArr);
        //die();
        $result=$m->add($tempArr);
        if($result){
            $this->ajaxReturn($result,'JSON');
        }else{
            $this->ajaxReturn(0,'JSON');
        }
    }

    
    //客户输入车牌号查询
    public function getguestinfojson(){
        //$m  = M('baofei','tab_','DB_LOCALHOST');
        $m  = M('baofei','tab_','DB_SAE');
        $result=$m->where("chepaihao='%s'",$_GET[chepaihao])->field('chepaihao,toubaoren,beibaoren,kehujuese,baodanhao,baodanhao4,toubaodanhao,toubaodanhao4,yinhangmingcheng,yinhangkahao,chushishijian')->select();   
        if($result){
            //$this->ajaxReturn($result,'JSON');
            //$data['kehuquerenshijian']=date('Y-m-d H:i:s',time());
            //$m->data($data)->where("chepaihao='%s'",$_GET[chepaihao])->save();
            $data = array('kehuquerenshijian' =>date('Y-m-d H:i:s',time()));
            $m->data($data)->where("chepaihao='%s'",$_GET[chepaihao])->save();
            $this->ajaxReturn($result+$data,'JSON');
            //echo "success";
        }else{
            $this->ajaxReturn(0,'JSON');
            //echo "faild";
        }
    }
    
    //post获取今日银行数据
    public function postdata(){
        $post_data = array(
            'sign' => '12345678',
            'batchNo' => '20180404-基础数据'
        );
        $urlStr='http://panda.etoppaas.com.cn/api/service/panda.offline.query.exhibition.date';
        $jsonData=send_post($urlStr, $post_data);
        var_dump($jsonData);
    }
    
    //json试验页2
    public function add(){
        //ajaxReturn(数据,‘提示信息’,状态)
        
        //$m=M('message');
        $m  = M('baodan','tab_','DB_SAE');
        //$m  = M('baodan','tab_','DB_LOCALHOST');
        if($m->add($_GET)){
            $this->ajaxReturn($_GET,'添加信息成功',1);
            //echo "success";
        }else{
            $this->ajaxReturn(0,'添加信息失败',0);
            echo "failed";
        }
    }
    //接收杨洋发送的POST数据,并存入数据库
    public function sendPost1(){
//         ini_set("error_reporting","E_ALL & ~E_NOTICE");
        
//         $header = [];
//         $header["requestId"] = "123456";
//         $header["version"]="1.0.0";
//         $header["Content-Type"] = "application/json";
        
//         $obj=[];
//         $obj["sign"]="12345678";
//         $obj["batchNo"]="20180411.25条数据";
//         $data = json_encode($obj);
        
//         $post_data = array(
//             'sign' => '12345678',
//             'batchNo' => '20180411.25条数据'
//         );
//         //print_r($header);die();
//         $str='{"sign":"12345678","batchNo":"20180411.25条数据"}';

//         $url = "http://panda.etoppaas.com.cn/api/service/panda.offline.query.exhibition.date";
        $m  = M('baodan','tab_','DB_SAE');
        //$m  = M('baodan','tab_','DB_LOCALHOST');
        $res = $this->send_post();        
        $data=json_decode($res);
        $dbArr=[];
        if($data->errorMsg=="操作成功"){//成功获取数据
            $i=$data->totalCount;//总条目数
            $infoData=$data->resultList;
            foreach ($infoData as $key=>$obj) {
                //$value=json_decode($obj);
                $dbArr['toubaodanhao']=$obj->proposalNo;//投保单号
                $dbArr['baodanhao']=$obj->policyNo; //保单号
                $dbArr['chepaihao']=$obj->carMark; //车牌号
                $dbArr['toubaoren']=$obj->holder; //投保人
                $dbArr['beibaoren']=$obj->insured; //被保人
                //$dbArr['biaozhunbaofei']=floor($obj->premium * $obj->commissionRate * 0.895 / 1.06 ); //投保金额*费率，并取整
                $dbArr['shijibaofei']=$obj->premium; //投保金额
                $dbArr['chechuanshui']=$obj->commissionRate; //费率
                $dbArr['baodanleixing']='商业险'; //只接收商业险
                $dbArr['chezhu']=$obj->holder; //车主
                $dbArr['baodanhao4']=substr($obj->proposalNo,-4); //投保单号后4位
                if($obj->agentCode=="00008708"){//重阳定义特殊渠道
                    switch($obj->commissionRate){
                        case '0.3553':
                            $dbArr['chechuanshui']="0.35";
                            break;
                        case '0.3316':
                            $dbArr['chechuanshui']="0.33";
                            break;
                        case '0.3079':
                            $dbArr['chechuanshui']="0.31";
                            break;
                        default:
                            $dbArr['chechuanshui']=$obj->commissionRate; //费率
                    }
                    $dbArr['biaozhunbaofei']=floor($dbArr['shijibaofei'] * $dbArr['chechuanshui'] * 1); //投保金额*费率，并取整
                }else{//其他渠道
                    $dbArr['chechuanshui']=$obj->commissionRate; //费率
                    $dbArr['biaozhunbaofei']=floor($dbArr['shijibaofei'] * $dbArr['chechuanshui'] * 0.895 / 1.06 ); //投保金额*费率，并取整
                }
                $dbArr['dailibianhao']=$obj->agentCode; //代理公司
                if($m->add($dbArr)){//添加数据库成功
                    $this->ajaxReturn($dbArr,'添加信息成功',1);
                    echo "成功添加第".($key+1)."条记录。<br>";
                }else{//添加数据库失败
                    $this->ajaxReturn(0,'添加信息失败',0);
                    echo "插入第".($key+1)."条数据失败";
                    return false;
                }
                //var_dump($dbArr);                                
                //echo $key.','.$value."<br/>";
            }
            echo "<h2>共添加".$i."条记录。</h2><br>";
            //var_dump($infoData) ;
        }else{//未成功获取数据
            
            echo "获取数据失败";
        }
        
    }
    /**
     * 发送post请求
     *POSTMan自动生成
     */
    function send_post() {
    
    $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://panda.91ins.com/api/service/panda.offline.query.exhibition.date",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $this->get_sign_date(),
          CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
            "Content-Type: application/json",
            "Postman-Token: 33b451d6-6e42-452a-b67a-8654093b4d40",
            "requestId: 123456",
            "version: 1.0.0"
          ),
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          return  $response;
        }
    }
    //获取批次号日期字符串
    public function get_sign_date(){
        $strDate=date("Ymd").".".date("md");
        $strDate= "20180428.0428";
        $signArr['sign']="12345678";
        $signArr['batchNo']=$strDate;
        return json_encode($signArr);        
    }
    
    //将保费信息表中的投保单号返回，取得相应保单号信息
    public function returntbdh(){
        $m  = M('baofei','tab_','DB_SAE');
        //$m  = M('baofei','tab_','DB_LOCALHOST');
        //$timestart= strftime("2018-04-26 00:00:00");
        //$timeend= strftime("2018-04-26 23:59:59");
        $timestart= strftime("%Y-%m-%d 00:00:00");
        $timeend= strftime("%Y-%m-%d 23:59:59");
//         var_dump($m->select());
//         die();
        $rd=$m->where("chushishijian >='$timestart' and chushishijian <='$timeend' ")->field('toubaodanhao')->select();
        if($rd){
            $this->ajaxReturn($rd,'JSON');
            //echo "success";
        }else{
            $this->ajaxReturn(0,'JSON');
            //echo "faild";
        }       
    }
    
    /**导出**/
    public function excelout(){
        $this->display();
    }
    public function msgout(){
        //$excel = A('Excel');
        //$this->getbaodanhao();//匹配一次保单号
        $xlsCell = array(
            array('chepaihao', '车牌号'),
            array('toubaoren', '投保人'),
            array('beibaoren', '被保人'),
            array('kehujuese', '客户角色'),
            array('baodanhao', '保单号'),
            array('toubaodanhao', '投保单号'),
            array('peisongyuanbianma', '折扣金额'),
            array('jisuanjine', '计算折扣'),
            array('zhekouchazhi', '折扣差值'),
            array('shangyexianbaofei', '商险保费'),
            array('feilv', '费率'),           
            array('yinhangmingcheng', '银行名称'),
            array('yinhangkahao', '银行卡号'),
            array('chushishijian', '派送时间'),
            array('kehuquerenshijian', '确认时间'),
            array('baodanhaoflag', '保单号状态'),
            array('bianmaflag', '折扣金额状态'),           
            array('dailigongsi', '代理公司'),
        );
        $xlsName = '保费表导出';
        $field = null;
        foreach ($xlsCell as $key => $value) {
            if($key == 0){
                $field = $value[0];
            }else{
                $field .= "," . $value[0];
            }
        }
        //var_dump($xlsCell);die();
        $xlsModel  = M('baofei','tab_','DB_SAE');
        //$xlsModel  = M('baofei','tab_','DB_LOCALHOST');
        $timestart= strftime("%Y-%m-%d 00:00:00");
        $timeend= strftime("%Y-%m-%d 23:59:59");
        //$timestart= strftime("2018-04-28 00:00:00");
       //$timeend= strftime("2018-05-01 23:59:59");
        $xlsData = $xlsModel->Field($field)->where("chushishijian >='$timestart' and chushishijian <='$timeend' and baodanhaoflag=1 and bianmaflag=1")->order('chushishijian DESC')->select();
        //$xlsModel = M('Staff');
//         if (IS_POST) {
//             $map = $this -> _queryTime();
//             $staff_name = I('staff_name');
//             if($staff_name) {
//                 if (is_numeric($staff_name)) {
//                     $map["id|staff_name"] = array(intval($staff_name), array('like', '%' . $staff_name . '%'), '_multi' => true);
//                 } else {
//                     $map['staff_name'] = array('like', '%' . (string)$staff_name . '%');
//                 }
//             }
//             $xlsData = $xlsModel->Field($field)->where($map)->order('id DESC')->select();
//         }
//         foreach ($xlsData as $k => $v) {
//             $xlsData[$k]['create_time'] = $v['create_time'] == null ? '-' : date("Y-m-d H:i",$v['create_time']);
//             $xlsData[$k]['status'] = $v['status'] == 1 ? '正常' : '禁用';
//         }
//         $excel->export_excel($xlsName,$xlsCell,$xlsData);
        $this->export_excel($xlsName,$xlsCell,$xlsData);
    }
    public function msgoutno(){
        //$this->getbaodanhao();//匹配一次保单号
        $xlsCell = array(
            array('chepaihao', '车牌号'),
            array('toubaoren', '投保人'),
            array('beibaoren', '被保人'),
            array('kehujuese', '客户角色'),
            array('baodanhao', '保单号'),
            array('toubaodanhao', '投保单号'),
            array('peisongyuanbianma', '折扣金额'),
            array('jisuanjine', '计算折扣'),
            array('zhekouchazhi', '折扣差值'),
            array('shangyexianbaofei', '商险保费'),
            array('feilv', '费率'),  
            array('yinhangmingcheng', '银行名称'),
            array('yinhangkahao', '银行卡号'),
            array('chushishijian', '派送时间'),
            array('kehuquerenshijian', '确认时间'),
            array('baodanhaoflag', '保单号状态'),
            array('bianmaflag', '折扣金额状态'),
            array('dailigongsi', '代理公司'),
        );
        $xlsName = '不一致保费表导出';
        $field = null;
        foreach ($xlsCell as $key => $value) {
            if($key == 0){
                $field = $value[0];
            }else{
                $field .= "," . $value[0];
            }
        }
        $xlsModel  = M('baofei','tab_','DB_SAE');
        //$xlsModel  = M('baofei','tab_','DB_LOCALHOST');
        $timestart= strftime("%Y-%m-%d 00:00:00");
        $timeend= strftime("%Y-%m-%d 23:59:59");
        //$timestart= strftime("2018-04-28 00:00:00");
        //$timeend= strftime("2018-05-01 23:59:59");
        $map['chushishijian'] =  array(array('egt',$timestart),array('elt',$timeend));
        $map['_query'] = 'baodanhaoflag=0 & bianmaflag= 0 & _logic=or';
        //$map['baodanhaoflag'] =  array('neq',1);
        //$map['bianmaflag'] =  array('eq',1);
        $xlsData = $xlsModel->Field($field)->where($map)->order('chushishijian DESC')->select();
        $this->export_excel($xlsName,$xlsCell,$xlsData);
    }
    /**
     * 数据导出为.xls格式
     * @param string $fileName 导出的文件名
     * @param $expCellName     array -> 数据库字段以及字段的注释
     * @param $expTableData    Model -> 连接的数据库
     */
    public function export_excel($fileName='table',$expCellName,$expTableData){
        $xlsTitle = iconv('utf-8', 'gb2312', $fileName);//文件名称
        $xlsName = $fileName.date("_Y.m.d_H.i.s"); //or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        Vendor('PHPExcel.PHPExcel');
        import("Vendor.PHPExcel.PHPExcel");
        import("Vendor.PHPExcel.Writer.Excel5");
        import("Vendor.PHPExcel.IOFactory.php");
    
        $objPHPExcel = new \PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
    
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $fileName.'  Export time:'.date('Y-m-d H:i:s'));
        //$objPHPExcel->getActiveSheet(0)->getStyle('I')->getNumberFormat()->setFormatCode('General');//设置银行卡号列为文本
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
        }
        // Miscellaneous glyphs, UTF-8
        for($i=0;$i<$dataNum;$i++){
            for($j=0;$j<$cellNum;$j++){
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3),  ' '.$expTableData[$i][$expCellName[$j][0]]);
            }
        }
    
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$xlsName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
    
    //杨洋获取投保单号后，生产相应的保单号，此处获取该保单号
    public function getbaodanhao(){
       
        $m  = M('baofei','tab_','DB_SAE');
        //$m  = M('baofei','tab_','DB_LOCALHOST');
        $res = $this->get_baodanhao_post();
        $data=json_decode($res);
        $dbArr=[];
        if($data->errorMsg=="操作成功"){//成功获取数据
            $i=$data->totalCount;//总条目数
            $infoData=$data->resultList;//具体保单号数据
            $tmep_i=1;
            foreach ($infoData as $obj) {
                //$value=json_decode($obj);
                //$dbArr['toubaodanhao']=$obj->proposalNo;//投保单号
                //$dbArr['baodanhao']=$obj->policyNo; //保单号
                if($obj->insureStatus=="Y"){//获取的相应的保单号
                    $dbArr = array('baodanhao' =>$obj->policyNo,'baodanhaoflag' =>'1');//保单号及保单号状态
                    $returndb=$m->data($dbArr)->where("toubaodanhao='%s'",$obj->proposalNo)->save();
                    if($returndb){//修改保单号成功
                        $this->ajaxReturn($dbArr,'匹配保单号成功',1);
                        echo "成功匹配第".$tmep_i."条保单号:".$obj->proposalNo."<br>";
                        $tmep_i++;
                    }else{//修改保单号失败
                        $this->ajaxReturn(0,'匹配保单号失败',0);
                        echo "匹配第".$tmep_i."条保单号失败-无此投保单号:".$obj->proposalNo."<br>";
                        $tmep_i++;
                        //return false;
                    }
                }else{//相应保单号为空insureStatus=="N"
                    $dbArr = array('baodanhao' =>$obj->errorMsg);//保单号
                    //$dbArr = array('baodanhaoflag' =>'0');//保单号状态
                    $returndb=$m->data($dbArr)->where("toubaodanhao='%s'",$obj->proposalNo)->save();
                }
                
            }
            echo "<h2>共执行".$i."条记录。</h2><br>";
            //var_dump($infoData) ;
        }else{//未成功获取数据
    
            echo "获取杨洋数据失败";
        }
    
    }
    /**
     * 发送post请求（为获取杨洋给的匹配保单号）
     *POSTMan自动生成
     */
    function get_baodanhao_post() {
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://panda.91ins.com/api/service/panda.offline.query.verify.date",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\t\"sign\": \"12345678\"\n}\n",
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache",
                "Content-Type: application/json",
                "Postman-Token: d136b1a2-c608-4f6f-b056-9e570a4953df",
                "requestId: 123456",
                "version: 1.0.0"
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return $response;
        }
       
    }
    
    //总体管理页面
    public function admin(){
        $this->display();
    }
        
}

class MessageController extends Controller{
    public function Myextends(){
        
    }
    public function send()
    {
        ini_set("error_reporting","E_ALL & ~E_NOTICE");
    
        $obj->phonenum = '1111111';
        $data =  json_encode($obj);
    
        $url = "http://www.****.cn/Api/Sync/phonenum";
    
        $res = $this->http_request($url, $data);
    
        echo $res;
    }
    
    // HTTP请求（支持HTTP/HTTPS，支持GET/POST）
    function http_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (! empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }   
    
}
