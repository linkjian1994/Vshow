<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model {
    protected $_auto = array(
        
    );

    protected $_validate = array(
        array('verifyCode','require','请输入验证码',0,'',4),
        array('verifyCode','checkFormVerifyCode','验证码错误，请重试',0,'callback',4),
        array('username','require','请填写用户名',0,'',4), 
        array('password','require','请填写密码',0,'',4), 
        array('username,password','checkUserLogin','用户名或密码错误！',1,'callback',4),
        
    );

    protected function checkUserLogin($data){

        $username = $data['username'];
        $password = md5($data['password']);

        $map = array(
            'username' => $username
        );

        $userInfo = $this->where($map)->field('id,password')->find();

        if ($userInfo['password'] == $password) {

            $data = array(
                'last_login' => NOW_TIME,
                'last_ip'    => get_client_ip()
            );

            $this->where('id='.$userInfo['id'])->save($data);

            session('UID',$userInfo['id']);
            session('username',$username);
                
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
}