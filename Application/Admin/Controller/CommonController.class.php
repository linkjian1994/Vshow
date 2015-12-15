<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
  public function _initialize()
  {
  	$auth = new \Think\Auth();

  	if (!$auth->check(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME,session('UID'))) 
  	{
    	$this->error('抱歉，您没有权限访问此页面',U('Home/Index/index'));
  	}
  }
}