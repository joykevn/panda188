<?php
namespace Home\Controller;
use Think\Controller;
//处理常州业务
class CzController extends Controller {
    //首页
    public function index(){
        $this->display();
    }
    
    //点击查询后，返回保单初始数据
    public function return_chushidata(){
        //ajaxReturn(数据,‘提示信息’,状态)
        //$m  = M('baodan','tab_','DB_LOCALHOST');
        $m  = M('chushidata','cz_','DB_dlSAE');
        $data=$m->where("chepaihao='%s'and toubaodanhao4='%s' and baodanleixing='商业险'",
            $_GET[chepaihao],$_GET[toubaodanhao4])
        ->field('toubaoren,beibaoren,baodanhao,baodanhao4,
            toubaodanhao,toubaodanhao4,jifenquanyima,baodanleixing,
            jisuanzhekou,shangxianbaofei,feilv,dailibianhao') 
        ->select();
        if(sizeof($data)){//有查询结果 而且是商业险
            $this->ajaxReturn($data,'JSON');
        }else{//无商业险查询结果
            $this->ajaxReturn(0,'JSON');
        }
    }
    //返回银行卡的银行名称和卡号
    public function upload_img_file(){
        //session_start();
        //$_SESSION["userid"]="zxh";
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
                $this->ajaxReturn($res,'JSON');
//                 $resArr=json_decode($res,true);
//                 echo "<h2>银行名称：".$resArr["result"]["bank_name"]. "</h2>";
//                 echo "<h2>银行卡号：".$resArr["result"]["bank_card_number"]. "</h2>";
                //var_dump($_POST);
                //echo $resArr["result"]["bank_name"];                
            }
        }else{
            echo "Invalid file";
        }
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
        $res = $this->request_img_post($url, $bodys);
        return $res;
    }
    /**
     * 发起http post请求(REST API), 并获取图片OCR识别结果
     * @param string $url
     * @param string $param
     * @return - http response body if succeeds, else false.
     */
    public function request_img_post($url = '', $param = '')
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
    
}



?>