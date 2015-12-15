<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index()
    {   
        $userDB = M('user');
        $counts = $userDB->count();

        $Page     = new \Think\VshowPage($counts,10);
        $show     = $Page->show();
        $userList = $userDB->field('id,username,truename,last_login,last_ip')->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('page',$show);
        $this->assign('userList',$userList);
        $this->display();
    }

    public function add()
    {   
        $groupDB = M('auth_group');
        $groupInfo =  $groupDB->field('id,title')->select();
        $this->assign('groupInfo',$groupInfo);
    	$this->display();
    }

    public function addAction()
    {
        $userModel = D('User');
        $res = $userModel->create($_POST,5);
        if ($res) {
            $userModel->password = md5($userModel->password);
            $userModel->reg_date = NOW_TIME;
            $res = $userModel->add();
            if ($res) {
                $this->success('新增用户成功');
            }
        }else{
            $this->error('新增用户失败：'.$userModel->getError());
        }
    }

    public function edit()
    {   
        $userID = I('get.id');

        if (!$userID) {
            $this->error('参数错误');
        }
        $userDB    =  M('user');
        $groupDB   =  M('auth_group');

        $userInfo  =  $userDB->where('id = '.$userID)->field('id,username,truename,group_id,email,status')->find();
        $groupInfo =  $groupDB->field('id,title')->select();
    
        $this->assign('groupInfo',$groupInfo);
        $this->assign('userInfo',$userInfo);

    	$this->display();
    }

    public function dologin()
    {
        if (!IS_POST) $this->error('非法请求',U('Index/index'));
        
        // 实例化Model,进行自动验证
        $userModel = D('Admin');
        $res = $userModel->create($_POST,4);

        // 返回信息
        if ($res) {
            $this->success('登录成功,正在跳转至管理页面',U('Index/index'));
        }else{
            $this->error('登录失败：'.$userModel->getError());
        }
    }

    public function logout()
    {
        if (session('adminID')) {
            session(null);
        }

        $this->success('注销成功,正在跳转至首页',U('Home/Index/index'));
    }

    public function editAction()
    {
        if (!IS_POST) $this->error('非法请求',U('Index/index'));
        $_POST['password'] = md5($_POST['password']);
        $userDB = M('user');

        $userDB->where('id = '.$_POST['id'])->data($_POST)->save();

        $groupDB = M('auth_group_access');
        $groupDB->where('uid = '.$_POST['id'])->save(array('group_id' => $_POST['group_id']));


        $this->success('修改成功');


    }

}