<?php
namespace Admin\Controller;
use Think\Controller;
class RuleController extends Controller {
    public function index()
    {   
        $authDB = M('auth_rule');
        $ruleList = $authDB->select();

        $this->assign('ruleList',$ruleList);
        $this->display();
    }

    public function add()
    {
    	$this->display();
    }

    public function addAction()
    {
        $name = $_POST['group'].'/'.$_POST['module'].'/'.$_POST['action'];

        $authDB = M('auth_rule');
        $data = array(
            'name'  => $name,
            'title' => $_POST['title'],
            'status' => $_POST['status'] 
        );
        $authDB->add($data);
        $this->success('新增规则成功');
    }

    public function edit()
    {   $authDB = M('auth_rule');
        $rule= $authDB->where(array('id' => I('get.id')))->select();
        // dump($rule);
        $this->assign('rule',$rule);
    	$this->display();
    }
}