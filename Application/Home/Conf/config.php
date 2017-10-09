<?php
return array(
	//'配置项'=>'配置值'
    'SESSION_AUTO_START' => true,                            //开启SESSION
    'DEFAULT_CHARSET' => 'utf-8',                            //编码设置

    'TMPL_PARSE_STRING' => array(
        '__PUBLIC__' => __ROOT__ . '/Public/',
    ),

    'DB_TYPE' => 'mysql',									//数据库类型
    'DB_HOST' => 'localhost',								//数据库主机
    'DB_NAME' => 'yyjh',										//数据库名称
    'DB_USER' => 'root',									//用户名
    'DB_PWD' => 'root',										//密码
    'DB_PORT' => '3306',									//端口
    'DB_PREFIX' => 'sl_',									//表前缀

    'SHOW_PAGE_TRACE' =>true,
);