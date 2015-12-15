<?php
namespace Admin\Controller;
use Think\Controller;
class HomeController extends Controller {
    public function index(){
    	$this->display('login');
    }

     /* 获取验证码 */
    public function getVerifyCode(){
    	$codeConfig = array(
    		'fontSize' => '14',
    		'length'   =>  '4',
    		'useCurve' =>  false,
    		'useNoise' =>  false,
    		'imageH'   =>  '33',
    	);

		$Verify = new \Think\Verify($codeConfig);
    	$Verify->entry();
    } 

}