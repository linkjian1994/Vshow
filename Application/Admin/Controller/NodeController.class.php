<?php
namespace Admin\Controller;
use Think\Controller;
class NodeController extends Controller {
    public function index()
    {   
     //    $authDB = M('auth_rule');
     //    $res = authDB->select();
    	// dump($res);exit;
     //    $this->display();
    }

    public function add()
    {
    	$this->display();
    }

   

    public function edit()
    {
    	$this->display();
    }
}