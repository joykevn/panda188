<?php
namespace MPhone\Model;
use Think\Model;
class UsersModel extends Model{
    //设置数据表前缀
    protected $tablePrefix = 'top_';
    //调用配置文件中的数据库配置1    
    protected $connection = 'DB_LOCALHOST_WORKDB';
}
