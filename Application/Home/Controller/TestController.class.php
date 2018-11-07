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
       // $this->error('插入失败，请重试……');
    }
    public function readxml(){
        $dingdan_temp_arr = array();
        $xml = simplexml_load_file('./other/psfenpei/psfp1020.xml');
        
        $Info_bd  = M('baodan106','info_','USED_DB');
        //$count=$Info_bd->count();
        $count=0;
        foreach($xml->children() as $DataRecord){
            $i=0;
            //$dingdan_temp_arr['id']=$count++;
            foreach ($DataRecord as $obj) {
                echo "<b>(". ++$i . ")：</b>";
                //echo $obj->getName() . ">>>>";
                $key=(string)$obj->getName();
                echo $key;
                echo '=>';
                echo $obj->attributes()->_v;
                $dingdan_temp_arr[$key]=(string)$obj->attributes()->_v;
                
            }
            //p($dingdan_temp_arr);
            //$dingdan_temp_arr['savedt']=date("Y-m-d H:i:s");
            //$dingdan_temp_arr['otherinfo']='1102集中写入';
            //$dbcount=$Info_bd->data($dingdan_temp_arr)->add();
            //echo ++$count . '->'.$dbcount.'<br>';
            echo "<h3>" . ++$count . ":---------" . "</h3>";
            //break;
        }
    }
    public function demo_get_data(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_PORT => "4545",
        CURLOPT_URL => "http://11.207.3.225:4545/tsinsur",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => '<SOAP-ENV:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:clr="http://schemas.microsoft.com/soap/encoding/clr/1.0" SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"><SOAP-ENV:Body><LookupInsur><xdata>&lt;DataRecordSet polcode=""&gt;&lt;DataRecord table="ts_insurinfo"&gt;&lt;startdate _v="2018-11-01" _chg="Y"/&gt;&lt;enddate _v="2018-11-02" _chg="Y"/&gt;&lt;/DataRecord&gt;&lt;DataRecord table="loginuser"&gt;&lt;branchcode _v="41010000" _chg="Y"/&gt;&lt;userid _v="410192167" _chg="Y"/&gt;&lt;/DataRecord&gt;&lt;/DataRecordSet&gt;</xdata></LookupInsur></SOAP-ENV:Body></SOAP-ENV:Envelope>
        ',
        CURLOPT_HTTPHEADER => array(
            "Accept: */*",
            "Accept-Encoding: gzip, deflate",
            "Accept-Language: zh-CN",
            "Cache-Control: no-cache",
            "Content-Length: 793",
            "Content-Type: text/xml; charset=utf-8",
            "DNT: 1",
            "Host: 11.207.3.225:4545",
            "Postman-Token: 17d690f6-d8b7-4f12-bec3-69e95f583c39",
            "Pragma: no-cache",
            "Proxy-Connection: Keep-Alive",
            "Referer: http://11.207.3.225/picctscenter/mainframe.htm",
            "User-Agent: Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; WOW64; Trident/7.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)",
            "soapaction: http://schemas.microsoft.com/clr/nsassem/Interact.TeleSales.InsurService/TsInsurService#LookupInsur"
        ),
        ));
        set_time_limit(36000); 
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        echo $response;
        }
    }
}
