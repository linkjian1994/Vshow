<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model {
	protected $_map = array(
		'uname'  => 'username',
		'pwd'    => 'password',
		'rqpwd'  => 'rqpassword',
		'mail'   => 'email',
		'newpwd' => 'newpassword'
		// 'stuid' => 'stu_id',
		// 'tname' => 'true_name'
	);

	protected $_auto = array(
		array('password','md5','5','function'),
		array('reg_date','time','5','function'),
		array('last_login','time','5','function'),
		array('last_ip','get_client_ip','5','function')
	);

	protected $_validate =array(
		/* 登录时验证 */
		array('username','require','请填写用户名',0,'',4), 
		array('password','require','请填写密码',0,'',4), 
		array('username,password,auth','checkUserLogin','用户名或密码错误！',1,'callback',4),

		/* 更改密码时验证 */
		array('password','require','请填写原密码',0,'',6), 
		array('password','6,15','原密码在6-15个字符之间',0,'length',6),
		array('newpassword','require','请填写新密码',0,'',6), 
		array('newpassword','6,15','原密码在6-15个字符之间',0,'length',6),
		array('rqpassword','require','请确认新密码',0,'',6), 
		array('rqpassword','newpassword','两次输入的密码不正确',0,'confirm',6),
		array('password,newpassword','modifyPassword','原密码不正确，请重试',1,'callback',6),
		/* 注册时验证 */
		array('username','require','请填写用户名',0,'',5), 
		array('username','','该用户名已被使用！',0,'unique',5), 
		array('username','4,15','用户名4-15个字符之间',0,'length',5), 

		array('password','require','请填写密码',0,'',5), 
		array('password','6,15','密码在6-15个字符之间',0,'length',5),
		array('rqpassword','require','请填写确认密码',0,'',5), 
		array('rqpassword','6,15','密码在6-15个字符之间',0,'length',5),
		array('rqpassword','password','两次输入的密码不正确',0,'confirm',5),
						
		/*array('stu_id','require','请填写学号',0,'',5),
		array('stu_id','number','学号应为数字',0,'',5), 
		array('stu_id','','该学号已被使用！',0,'unique',5),*/

		array('truename','require','请填写真实姓名',0,'',5), 
		array('truename','','该姓名已存在',0,'unique',5),

		array('email','require','请填写电子邮件',0,'',5), 
		array('email','email','电子邮件格式不正确',0,'',5), 
		array('email','','电子邮件已存在！',0,'unique',5), 

		// array('class_id','require','请选择班级',0,'',5),

		array('verifyCode','require','请输入验证码',0,'',5),
		array('verifyCode','checkFormVerifyCode','验证码错误，请重试',0,'callback',5),

		array('sign','require','请填写密码',0,'',7), 
		array('sign','1,40','签名在1-40个字符之间',0,'length',7),


		array('username','require','请填写用户名',0,'',8), 
		array('email','require','请填写电子邮件',0,'',8), 
		array('email','email','电子邮件格式不正确',0,'',8), 
		array('username,email','resetPassword','用户名和邮箱不匹配，请重试',1,'callback',8),

	/*	array('checkcode','require','请填写验证码',0,'',1),
		array('checkcode','checkCode','验证码填写错误！',0,'callback',1), 
		array('username,password,me','checkUserLogin','用户名或密码错误！',1,'callback',4),*/
	);

	protected function checkUserLogin($data){

		$username = $data['username'];
		$password = md5($data['password']);

		$map = array(
			'username' => $username, 
			'password' => $password
		);

		$userInfo = $this->where($map)->field('id,status,avater_path,truename')->find();

		if ($userInfo) {
			if ($userInfo['status'] == 0) return false;
			if ('on' == $data['auth']) {
				setcookie("UID", $userInfo['id'], time()+3600*24*30,'/');
				setcookie("avaterPath", $userInfo['avater_path'], time()+3600*24*30,'/');
			}
			$data = array(
				'last_login' => NOW_TIME,
				'last_ip'    => get_client_ip()
			);

			$this->where('id='.$userInfo['id'])->save($data);

			session('UID',$userInfo['id']);
			session('truename',$userInfo['truename']);
			session('avaterPath',$userInfo['avater_path']);

			$db   =  M('auth_group_access');
            $map  =  array('uid' => session('UID'));
            $info =  $db->where($map)->field('group_id')->find();

            session('group_id', $info['group_id']);
				
			return true;
		}else{
			return false;
		}
	}

	protected function checkFormVerifyCode($data){
		$verify = new \Think\Verify();
    	$res = $verify->check($data);
    	if ($res) {
    		return true;
    	}else{
    		return false;
    	}
	}

	public function modifyPassword($data){
		$password = md5($data['password']);
		$new_password = md5($data['newpassword']);

		$user_id = Session('UID');

		$_map = array('id' => $user_id, 'password' => $password);

		$res = $this->where($_map)->find();

		if (!$res) return false;
		
		$_map  = array('id' => $user_id);

		$_data = array('password' => $new_password);

		$res = $this->where($_map)->save($_data);

		if ($res) {
			session('UID',null);
			return true;
		}
	}

	public function resetPassword($data)
	{
		$username = $data['username'];
		$email    = $data['email'];

		$map = array(
			'username' => $username,
			'email'	   => $email 	
		);

		$res = $this->where($map)->count();

		return ($res > 0) ? true : false;  
	}
}