<?php
namespace Admin\Model;
use Think\Model;
class UserModel extends Model {
    protected $_auto = array(
        
    );

    protected $_validate = array(
        // 添加用户时验证
        array('username','require','请填写用户名',0,'',5), 
        array('username','','该用户名已被使用！',0,'unique',5), 
        array('username','4,15','用户名4-15个字符之间',0,'length',5),
       
        array('password','require','请填写密码',0,'',5), 
        array('password','6,15','密码在6-15个字符之间',0,'length',5),

        array('truename','require','请填写真实姓名',0,'',5), 
        array('truename','','该姓名已存在',0,'unique',5),

        array('email','require','请填写电子邮件',0,'',5), 
        array('email','email','电子邮件格式不正确',0,'',5), 
        array('email','','电子邮件已存在！',0,'unique',5), 
        
    );
    
}