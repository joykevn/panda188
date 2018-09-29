<?php
return array(
	//'配置项'=>'配置值'
    //本地数据库配置1
    'DB_LOCALHOST' => array(
        'db_type'  => 'mysql',
        'db_user'  => 'root',
        'db_pwd'   => '553322',
        'db_host'  => 'localhost',
        'db_port'  => '3306',
        'db_name'  => 'app_sz88',
        'db_charset'=>'utf8',
    ),
    //本地数据库配置2
    'DB_LOCALHOST' => array(
        'db_type'  => 'mysql',
        'db_user'  => 'root',
        'db_pwd'   => '553322',
        'db_host'  => 'localhost',
        'db_port'  => '3306',
        'db_name'  => 'workdb',
        'db_charset'=>'utf8',
    ),
    //数据库配置2-新浪云共享数据库
    'DB_SAE' => array(
        'db_type'  => 'mysql',
        'db_user'  => 'x40lnjx32y',
        'db_pwd'   => 'xzk043yjy14xz3xh1zizkikm31mzm110hj0zh55l',
        'db_host'  => 'w.rdc.sae.sina.com.cn',
        'db_port'  => '3306',
        'db_name'  => 'app_sz88',
        'db_charset'=>'utf8',
    ),    
    //数据库配置3-新浪云独立数据库
    'DB_dlSAE' => array(
        'db_type'  => 'mysql',
        'db_user'  => 'maildbuser',
        'db_pwd'   => 'maildbuser553322',
        'db_host'  => 'kwtdutauospb.mysql.sae.sina.com.cn',
        'db_port'  => '10604',
        'db_name'  => 'web_maildb',
        'db_charset'=>'utf8',
    ),
    //U()函数的伪静态后缀名，默认为: .html
    //'URL_HTML_SUFFIX'=>"",
    //404页面配置地址
    'TMPL_EXCEPTION_FILE' => 'Public/_404.html',
    //邮件服务器
//     'MAIL_HOST' =>'smtp.163.com',//smtp服务器的名称
//     'MAIL_PORT'=>25,
//     'MAIL_SMTPAUTH' =>TRUE, //启用smtp认证
//     'MAIL_USERNAME' =>'nanjingpamd',//发件人的邮箱名
//     'MAIL_PASSWORD' =>'aassddff00',//163邮箱发件人授权密码
//     'MAIL_FROM' =>'nanjingpamd@163.com',//发件人邮箱地址
//     'MAIL_FROMNAME'=>'南京',//发件人姓名
//     'MAIL_CHARSET' =>'utf-8',//设置邮件编码
//     'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件
    //邮件配置
//     'MAIL_CHARSET'=>'UTF-8',
//     'MAIL_PORT'=>25,
//     'MAIL_HOST'=>'smtp.163.com',
//     'MAIL_USER'=>'nanjingpamd@163.com',
//     'MAIL_PASS'=>'aassddff00',
//     'MAIL_COM_NAME'=>'nanjingpamd@163.com',
//     'MAIL_ALT'=>'To view the message, please use an HTML compatible email viewer!',
//     'MAIL_WORDWRAP'=>100,

    // 配置邮件发送服务器
//     'MAIL_HOST' =>'smtp.163.com',//smtp服务器的名称
//     'MAIL_SMTPAUTH' =>TRUE, //启用smtp认证
//     'MAIL_PORT'   => '25', //SMTP服务器端口
//     'MAIL_USERNAME' =>'nanjingpamd@163.com',//你的邮箱名
//     'MAIL_FROM' =>'nanjingpamd@163.com',//发件人地址
//     'MAIL_FROMNAME'=>'南京',//发件人姓名
//     'MAIL_PASSWORD' =>'aassddff00',//邮箱密码切记是邮箱授权码
//     'MAIL_CHARSET' =>'utf-8',//设置邮件编码
//     'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件
    
    
);