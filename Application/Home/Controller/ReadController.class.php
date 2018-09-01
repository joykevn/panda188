<?php
namespace Home\Controller;
use Think\Controller;

class ReadController extends Controller {
    //首页
    public function index(){
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        //echo "ThinkPHP,1";
        $arr=array(1,3,4,5,6,7,8,9,2,3,4);
        var_dump($this->partition($arr,3));
        //$this->display();
    }
    //查询初始数据未录入的投保单号，并输出，以便于再次录入
    public function cha_toubaodan(){
        $m  = M('baodan','tab_','DB_SAE');
        //$m = M('baodan','tab_','DB_LOCALHOST');
        $arr_excel=C('baodanYan');
        $i_yes=0;$i_no=0;
        $retArr=[];
        foreach ($arr_excel as $key=>$value){
            $result = $m->where("toubaodanhao='%s'",$value)->select();
            if($result){//查询到        
                $i_yes++;
            }else{//查询不到
                $retArr[$i_no]=$value;
                $i_no++;                
            }
        }
        echo "此次数据总数为：".($key+1)."<br>";
        echo "现已录入数据为：".$i_yes."<br>";
        echo "现未录入数据为：".$i_no."<br>";
        foreach ($retArr as $value){
            echo '"'.$value.'",<br>';
        }
    }
    //匹配保单数据
    public function pipei_baodanhao(){
        //$m  = M('baofei','tab_','DB_SAE');
        //$m = M('baofei','tab_','DB_LOCALHOST');
        $arr=$this->return_my_tbdh();
//var_dump($arr);die();
        $i=1;
        foreach ($arr as $obj) {
            echo $i++.":".$obj['toubaodanhao']."<br>";
            
        } 
    }
    //将保费信息表中的投保单号返回，取得相应保单号信息
    public function return_my_tbdh(){
        $m  = M('baofei','tab_','DB_SAE');
        //$m  = M('baofei','tab_','DB_LOCALHOST');
        //$timestart= strftime("2018-04-25 00:00:00");
        //$timeend= strftime("2018-04-25 23:59:59");
        $timestart= strftime("%Y-%m-%d 00:00:00");
        $timeend= strftime("%Y-%m-%d 23:59:59");
        //         var_dump($m->select());
        //         die();
        $rd=$m->where("chushishijian >='$timestart' and chushishijian <='$timeend' ")->field('toubaodanhao')->select();
        if($rd){
            return $rd;
            //$this->ajaxReturn($rd,'JSON');
            //echo "success";
        }else{
            return 0;
            //$this->ajaxReturn(0,'JSON');
            //echo "faild";
        }
    }
    
    //从独立数据库到共享数据库
    public function db2db(){
        $dlm  = M('baodan','tab_','DB_dlSAE');//独立库
        $gxm  = M('baodan','tab_','DB_SAE');//共享库
        $arr=$dlm->field("baodanhao,toubaodanhao,baodanhao4,chepaihao,chezhu,beibaoren,toubaoren,biaozhunbaofei,shijibaofei,chechuanshui,baodanleixing,dailibianhao")->select();
        //var_dump($arr);die();
        foreach ($arr as $key => $value){            
            $result = $gxm->add($value); // 写入数据到数据库
            if($result){// 如果主键是自动增长型 成功后返回值就是最新插入的值
                echo "第".$key."个数据，ID为：".$result."<br>";
            }           
        }       
        //var_dump($arr);
    }
    //清空独立库的tab_baodan表
    public function clr_dl_db(){
        $dlm  = M('baodan','tab_','DB_dlSAE');//独立库
        $sql = 'TRUNCATE `' .$operDbName.'tab_baodan`';
        $ret = $dlm->execute($sql);
        if (!$ret) {
            echo $dlm->getDbError();
        }
    }
    //特殊需求，根据承保表查询银行信息
    public function getchengbaoinfo(){
        $arr=C('chengbaoArr');
        //var_dump($arr);die();
        $m  = M('baodan','tab_','DB_SAE');
        foreach ($arr as $value){
            
        }
    }
    
    public function chengbaoout(){
        set_time_limit(0);//0表示不限时
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
        $xlsName = '承保信息导出导出表';
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
        //$timestart= strftime("%Y-%m-%d 00:00:00");
        //$timeend= strftime("%Y-%m-%d 23:59:59");
        //$timestart= strftime("2018-04-25 00:00:00");
        //$timeend= strftime("2018-04-25 23:59:59");
        //$map['chushishijian'] =  array(array('egt',$timestart),array('elt',$timeend));
        //$map['_query'] = 'baodanhaoflag=0 & bianmaflag= 0 & _logic=or';
        //$map['baodanhaoflag'] =  array('neq',1);
        //$map['bianmaflag'] =  array('eq',1);
        $arr1=C('chengbaoArr');
        
        //$xlsData=[];
        foreach ($arr1 as $key => $value){            
            $result = $xlsModel->Field($field)->where("toubaodanhao='%s'",$value)->select();
            if($result){//查询到
                $xlsData[$key]=$result[0];
            }else{//查询的到                
                $xlsData[$key]['toubaodanhao']=$value;
                $xlsData[$key]['chepaihao']="未派送";
                $xlsData[$key]['baodanhao']="未派送";
            }
        }
        //var_dump($xlsData);die();
        A('Index')->export_excel($xlsName,$xlsCell,$xlsData);
    }
    
    
    //并发访问初始数据
    public function bingfa(){
        //echo "x为：".$x;die();
        $this->clr_dl_db();//清除独立库中的tab_baodan表，为此次存入开辟空间
        $arr=array_chunk(C('baodanArr'), 24);
        //var_dump(C('baodanArr'));die();
        //echo "baodanArr:".sizeof(C('baodanArr'))."<br>";
        foreach ($arr as $key=>$valueArr){
            $this->put_chushishuju_datebase($valueArr);
            //echo "第".($key+1)."访问<br>";
            //echo $key."-->".sizeof($valueArr)."<br>";
        }
        
    }
    
    
    //将获得的保单详情存入数据库，每天晚上准备第二条数据
    public function put_chushishuju_datebase($surArr){
        set_time_limit(0);//0表示不限时
        //$m  = M('baodan','tab_','DB_dlSAE');
        //$m  = M('baodan','tab_','DB_SAE');
        //$m = M('baodan','tab_','DB_LOCALHOST');
//         $surArr=array("51012023900604013896",
// "51012053900604015253",
// "51012053900604017347",
// "51012473900604018125",
// "51012053900604020591",
// "51012053900605847071"//商业险
//         );

        $i=1;
        foreach ($this->partition($surArr,round(count($surArr)/8)) as $value) {
            $desArr=json_decode($this->get_chushidata_json($value));            
            foreach ($desArr->proposalInfos as $obj) {
                if($obj->bizProposalNo){//非空为商业险，否则为交强险                    
                    $dbArr['toubaodanhao']=$obj->bizProposalNo;//投保单号
                    //$dbArr['baodanhao']=$obj->bizPolicyNo; //保单号
                    $dbArr['dailibianhao']=$obj->agentCode;//代理编号
                    $dbArr['chepaihao']=$obj->vehicleInfo->carMark; //车牌号
                    $dbArr['toubaoren']=$obj->policyHolder->relatedPartyName; //投保人
                    $dbArr['beibaoren']=$obj->insured->relatedPartyName; //被保人
                    $dbArr['shijibaofei']=$obj->bizPremium; //投保金额
                    $dbArr['baodanleixing']='商业险'; //只接收商业险
                    $dbArr['chezhu']=$obj->ownerInfo->relatedPartyName; //车主
                    $dbArr['baodanhao4']=substr($obj->bizProposalNo,-4); //投保单号后4位
                    
                    if($obj->agentCode=="00008708"){//重阳定义特殊渠道
                        switch($obj->bizRate){
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
                                $dbArr['chechuanshui']=$obj->bizRate; //费率
                        }
                        $dbArr['biaozhunbaofei']=floor($dbArr['shijibaofei'] * $dbArr['chechuanshui'] * 1); //投保金额*费率，并取整
                    }else{//其他渠道
                        $dbArr['chechuanshui']=$obj->bizRate; //费率             
                        $dbArr['biaozhunbaofei']=floor($dbArr['shijibaofei'] * $dbArr['chechuanshui'] * 0.895 / 1.06 ); //投保金额*费率，并取整
                    }
                                   
                    //var_dump($dbArr);echo("<h2>----------------------------</h2><br>");//die();                   
                    $m  = M('baodan','tab_','DB_dlSAE');
                    if($m->add($dbArr)){//添加数据库成功
                        $this->ajaxReturn($dbArr,'添加信息成功',1);
                        echo "成功添加第".$i."条记录。<br>";
                        $i++;
                    }else{//添加数据库失败
                        $this->ajaxReturn(0,'添加信息失败',0);
                        echo "插入第".$i."条数据失败。<br>";
                        $i++;
                        //return false;
                    }               
                }
            }//foreach 内部
        }
        echo "<h2>共添加".--$i."条记录。</h2><br>";
    }
    //把一个数组分成几个数组
    //$arr 是数组
    //$num 是数组的个数
    public function partition($arr,$num){
        //数组的个数
        $listcount=count($arr);
        if($num==0){$num=1;}
        //分成$num 个数组每个数组是多少个元素
        $parem=floor($listcount/$num);
        //分成$num 个数组还余多少个元素
        $paremm=$listcount%$num;
        $start=0;
        for($i=0;$i<$num;$i++){
            $end=$i<$paremm?$parem+1:$parem;
            $newarray[$i]=array_slice($arr,$start,$end);
            $start=$start+$end;
        }
        return $newarray;
    }
    //POST形式获取保单详情（初始数据）
    public function get_chushidata_json($arr){//获取初始数据
        $curl = curl_init();
        $tempStr=$this->made_str($arr);
        $tempArr=array(
            CURLOPT_URL => "http://pingan.91ins.com/wrs/transaction/query/proposals.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $tempStr,
            //"CURLOPT_POSTFIELDS2" => "{\"password\": \"FV5tr7h1\",\"phone\": \"18612445297\",\"policyInfos\": [{\"bizProposalNo\":\"51012473900590173735\"},{\"bizProposalNo\":\"50164003900593292976\"},],\"username\": \"BJYTCSBZXY-00001\"}",
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache",
                "Content-Type: application/json",
                "Postman-Token: 5df0e892-3351-4f06-9427-d62f446d3229"
            ),
        );
        curl_setopt_array($curl,$tempArr);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //print_r($response);die();
            return $response;
            
        }       
    }
    
    public function made_str($myArr){
        //$myArr=array("51012473900590173735","50164003900593292976");
        //$jjson=json_encode($myArr);
        //{\"bizProposalNo\": \"51012473900590173735\"},
        $headStr='{"password":"FV5tr7h1","phone":"18612445297","policyInfos":[';
        $endStr='],"username": "BJYTCSBZXY-00001"}';
        $dataStr='';
        foreach ($myArr as $value) {
            $dataStr=$dataStr.'{"bizProposalNo":"'.$value.'"},';            
        }
        //echo $headStr.$dataStr.$endStr;die();
        return $headStr.$dataStr.$endStr;
    }
}