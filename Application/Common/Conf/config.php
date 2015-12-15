<?php
return array(
	//'配置项'=>'配置值'
	//数据库配置信息
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'v_show', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => '', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'vs_', // 数据库表前缀 
	'DB_CHARSET'=> 'utf8', // 字符集
	'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增

    'MAIL_HOST'     =>  'smtp.163.com',      // SMTP服务器地址
    'MAIL_AUTH'     =>  true,                // 是否邮箱认证
    'MAIL_HTML'     =>  true,                // 正文是否使用HTML代码
    'MAIL_PORT'     =>  25,                  // SMTP服务器端口号
    'MAIL_CHARSET'  =>  'UTF-8',             // 正文使用编码
    'MAIL_USERNAME' =>  '', // 邮箱登录帐号
    'MAIL_PASSWORD' =>  '',          // 邮箱登录密码
    'MAIL_FROMNAME' =>  'Vshow',             // 显示名称

    'COURSE_PATH'  =>  __ROOT__.'/Uploads/course/',
    'USER_PATH'  => './Uploads/User/',

    'LOG_RECORD' => true, // 开启日志记录
    
    // 'SHOW_PAGE_TRACE' =>true, 

    'TRACE_PAGE_TABS'=>array(     
        'base'=>'基本',     
        'file'=>'文件',     
        'think'=>'流程',     
        'error'=>'错误',     
        'sql'=>'SQL',     
        'debug'=>'调试',     
        'user'=>'用户'
    )
);
