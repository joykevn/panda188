<?php
return array(
	//'配置项'=>'配置值'
    'DEFAULT_MODULE'=>'MPhone',//配置MPHONE为默认模块

    //本地数据库配置1
    'DB_LOCALHOST_SZ88' => array(
        'db_type'  => 'mysql',
        'db_user'  => 'root',
        'db_pwd'   => '553322',
        'db_host'  => '127.0.0.1',
        'db_port'  => '3306',
        'db_name'  => 'app_sz88',
        'db_charset'=>'utf8',
    ),
    //本地数据库配置2
    'DB_LOCALHOST_WORKDB' => array(
        'db_type'  => 'mysql',
        'db_user'  => 'root',
        'db_pwd'   => '553322',
        'db_host'  => '127.0.0.1',
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
);
