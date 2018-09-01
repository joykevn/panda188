<?php
namespace Home\Controller;
use Think\Controller;

class OcrController extends Controller {
    //文字识别常量定义，百度云控制台中创建
    const APP_ID = '11176110';
    const API_KEY = 'rhNPqUwcZfEh4pOGEAGZRmhb';
    const SECRET_KEY = 'fVs0CMx6EeSN2pdcgmGkYiXGM0Z12NdF';
    //入口测试函数
    public function index(){
        //$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
        //echo "ThinkPHP,1";
        $arr=array(1,3,4,5,6,7,8,9,2,3,4);
        var_dump($arr);
        echo("hello");
        //$this->display();
    }
    //上传图片试验
    public function photo(){
        $this->display();
    }
    //上传图片试验
    public function photo1(){
        //var_dump(U('Ocr/photo1'));die();
        $this->display();
    }
    //图片处理程序
    public function upload_file(){
        session_start();
        $_SESSION["userid"]="zxh";
        $resArr=[];
        if (1)//这个地方可以填写上传文件的限制，比如格式大小要求等，为了方便测试，这里没有写上传限制。
        {
            if ($_FILES["file"]["error"] > 0)
            {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";//获取文件返回错误
            }
            else
            {
                //打印文件信息
                //var_dump($_FILES);
                $res=$this->getimgstr($_FILES["file"]["tmp_name"]);
                $resArr=json_decode($res,true);
                echo "<h2>银行名称：".$resArr["result"]["bank_name"]. "</h2>";
                echo "<h2>银行卡号：".$resArr["result"]["bank_card_number"]. "</h2>";
                //var_dump($_POST);
                //echo $resArr["result"]["bank_name"];
               
                die();
                echo "Upload: " . $_FILES["file"]["name"] . "<br />";//获取文件名
                echo "Type: " . $_FILES["file"]["type"] . "<br />";//获取文件类型
                echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";//获取文件大小
                echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";//获取文件临时地址
        
                //自定义文件名称
                $array=$_FILES["file"]["type"];
                $array=explode("/",$array);
                $newfilename="new_name";//自定义文件名（测试的时候中文名会操作失败）
                $_FILES["file"]["name"]=$newfilename.".".$array[1];
        
                if (!is_dir("upload/".$_SESSION["userid"]))//当路径不穿在
                {
                    mkdir("upload/".$_SESSION["userid"]);//创建路径
                }
                $url="upload/".$_SESSION["userid"]."/";//记录路径
                if (file_exists($url.$_FILES["file"]["name"]))//当文件存在
                {
                    echo $_FILES["file"]["name"] . " already exists. ";
                }
                else//当文件不存在
                {
                    $url=$url.$_FILES["file"]["name"];
                    move_uploaded_file($_FILES["file"]["tmp_name"],$url);
                    echo "Stored in: " . $url;
                    $this->getimgstr($url);
                }
            }
        }
        else
        {
            echo "Invalid file";
        }
    }
    //OCR识别方法
    public function get_ocr(){
        //Vendor('baiduOCR.AipOcr#class');
        vendor('baiduOCR.AipOcr','','.class.php');
        
        // 创建OCR客户端
       $client = new \AipOcr(APP_ID, API_KEY, SECRET_KEY);
       $imgStr = __ROOT__."/Public/joyshang/img/yinhangka.jpg";
       $image = file_get_contents($imgStr);
       // 调用银行卡识别
       $return=$client->bankcard($image);
       $return2=$client->basicGeneral($image);
       var_dump($return2);
    }
    //输入图片路径，进行图片OCR识别
    public function getimgstr($img_path){               
        $token = '24.d92fd35b785762d5f653db475b4c1ed2.2592000.1527744811.282335-11176110';
        $url = 'https://aip.baidubce.com/rest/2.0/ocr/v1/bankcard?access_token=' . $token;
        
        //$img_path="yinhangka.jpg";
        
        $img = file_get_contents($img_path,true);
        
        $img = base64_encode($img);
        $bodys = array(
            "image" => $img
        );
        $res = $this->request_post($url, $bodys);
        return $res;
//         echo "银行名称：".$res->result->bank_name."<br>";
//         echo "银行卡号：".$res->result->bank_card_number."<br>";
        
//         var_dump($res);
        
    }
    /**
     * 发起http post请求(REST API), 并获取REST请求的结果
     * @param string $url
     * @param string $param
     * @return - http response body if succeeds, else false.
     */
    public function request_post($url = '', $param = '')
    {
        if (empty($url) || empty($param)) {
            return false;
        }
    
        $postUrl = $url;
        $curlPost = $param;
        // 初始化curl
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $postUrl);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        // 要求结果为字符串且输出到屏幕上
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // post提交方式
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        // 运行curl
        $data = curl_exec($curl);
        curl_close($curl);
    
        return $data;
    }
    
    public function get_baidu_token(){            
        $curl = curl_init();       
        curl_setopt_array($curl, array(
              CURLOPT_URL => "https://aip.baidubce.com/oauth/2.0/token?grant_type=client_credentials&client_id=rhNPqUwcZfEh4pOGEAGZRmhb&client_secret=fVs0CMx6EeSN2pdcgmGkYiXGM0Z12NdF",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache",
                "Postman-Token: b6abd838-9718-49f9-89a5-1194e163bb5d"
              ),
          ));
        
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