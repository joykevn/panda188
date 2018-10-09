<?php
return array(
	//'配置项'=>'配置值'
	'DEFAULT_CONTROLLER'    =>  'Psyindex', // 默认控制器名称
	'DEFAULT_ACTION'        =>  'index', // 默认操作名称
	
	//全局配置当前使用的数据库，便于网络移植
	'USED_DB'=>C('DB_LOCALHOST_WORKDB'),//本地数据库workdb
	//'USED_DB'=>C('DB_LOCALHOST_SZ88'),//本地数据库sz88
	//'USED_DB'=>C('DB_SAE'),//新浪云共享数据库
	//'USED_DB'=>C('DB_dlSAE'),//新浪云独立数据库

	'TMPL_EXCEPTION_FILE'            => './Public/_404.html',
);