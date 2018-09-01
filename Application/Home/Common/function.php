<?php
/**
 * 发送post请求
 * @param string $url 请求地址
 * @param array $post_data post键值对数据
 * @return string
 */
function send_post($url, $post_data) {

    $postdata = http_build_query($post_data);
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => array(
                'Content-type'=>'application/json',
                'requestId'=>'123456',
                'version'=>'1.0.0',                
            ),
            'content' => $postdata,
            'timeout' => 15 * 60 // 超时时间（单位:s）
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    return $result;
}

function to_send_mail($mail,$to,$subject,$body){
    ini_set("magic_quotes_runtime",0);
    try {
        $mail->IsSMTP();
        $mail->CharSet =C('MAIL_CHARSET');
        $mail->SMTPAuth = true;
        $mail->Port = C('MAIL_PORT');
        $mail->Host = C('MAIL_HOST');
        $mail->Username = C('MAIL_USER');
        $mail->Password = C('MAIL_PASS');
        $mail->AddReplyTo(C('MAIL_USER'),C('MAIL_COM_NAME'));
        $mail->From = C('MAIL_USER');
        $mail->FromName = C('MAIL_FROMNAME');
        $mail->AddAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = C('MAIL_ALT');
        $mail->WordWrap = C('MAIL_WORDWRAP');
        //$mail->AddAttachment("1.gif");
        $mail->IsHTML(true);
        $mail->Send();
        return true;
    } catch (\Org\Util\phpmailerException $e) {
        return $e->errorMessage();
    }
}

/**
 *邮件发送函数
 */
function send_email($to, $title, $content) {
    //Vendor('PHPMailer.PHPMailerAutoload');
    $mail = new \Org\Util\PHPMailer(); //实例化
    $mail->IsSMTP(); // 启用SMTP
    $mail->SMTPSecure = "ssl";
    $mail->Port= C ('MAIL_PORT');  // SMTP服务器的端口号
    $mail->Host=C('MAIL_HOST'); //smtp服务器的名称
    $mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证
    $mail->Username = C('MAIL_USERNAME'); //你的邮箱名
    $mail->Password = C('MAIL_PASSWORD') ; //邮箱密码
    $mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
    $mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
    $mail->AddAddress($to,"尊敬的客户");
    $mail->WordWrap = 50; //设置每行字符长度
    $mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
    $mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
    $mail->Subject =$title; //邮件主题
    $mail->Body = $content; //邮件内容
    $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端";
    $mail->SMTPDebug = 0;//需要做调试时值设为1
    return($mail->Send());
}