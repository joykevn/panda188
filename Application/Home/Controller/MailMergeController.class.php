<?php
namespace Home\Controller;
use Think\Controller;

class MailMergeController extends Controller {
    //首页
    public function index(){
        $m  = M('main','tab_','DB_dlSAE');
        //$m = M('baofei','tab_','DB_LOCALHOST');
        var_dump($m->select());
    }
    
    public function send_mail(){
        $to = $_POST['email'];
        $subject = 'ThinkPHP && PHPMailer 邮件发送';
        $body = '<h1>phpmail演示</h1>ThinkPHP && PHPMailer 邮件发送' ;
        $mail = new \Org\Util\PHPMailer(true);
        $re = to_send_mail($mail,$to,$subject,$body);
        var_dump($re);
    }
    
    public function send(){
        if(send_email('nanjingpamd@163.com','你好!邮件标题','这是一篇测试邮件正文！')){
            echo '发送成功！';
        }
        else{
            echo '发送失败！';
        }
    }
    
}