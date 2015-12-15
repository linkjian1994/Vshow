<?php
namespace Home\Controller;

use Think\Controller;

class TeacherCenterController extends Controller 
{

	public function _initialize()
	{	 
		// Auth验证，为了方便开发，暂时注释
		// A('Admin/Common');
	}

    public function index()
    {   

        $userID = session('UID');
        
        $userDB = M('user');
        
        $map    = array('id' => $userID);
        
        $field  = 'email,truename,sign';
        
        $user   = $userDB->where($map)->field($field)->find();

        // dump($courseList);exit;
        $this->assign('user',$user);

        $courseModel = M('course');
        $fieldStr    = 'id,course_name,course_about,course_pv,course_image,teacher_name';
        $courseList  = $courseModel->where('teacher_id = '.session('UID'))->field($fieldStr)->select();
    
        $String = new \Org\Util\String();
        $nums = count($courseList);
        for ($i=0; $i <$nums ; $i++) { 
            $courseAbout = $courseList[$i]['course_about'];
            if (iconv_strlen($courseAbout,'utf-8')>=60) {
                $courseList[$i]['course_about'] = $String::msubstr($courseAbout,0,60);
            }
        }

        $this->assign('courseList',$courseList);

        $this->display();
    }
    
	public function courseAdd()
	{	
		$this->display();
	}

	public function CourseAddAction()
	{  
        if (!IS_POST) $this->error('非法请求',U('Index/index'));

        $rules = array(
			array('course_name','require','请填写课程名称',0,'',4), 
			array('course_name','0,12','课程名称在12个字符以内',0,'length',4),
			array('course_about','require','请填写课程简介',0,'',4), 
			array('course_about','0,200','课程名称在200个字符以内',0,'length',4),
		);
		$courseModel = M('course');    
        $res = $courseModel->validate($rules)->create();
 		if (!$res) {
            $this->ajaxReturn(get_ajax_res(0, '添加课程失败：'.$courseModel->getError()));
        }

        $rootPath          =   './Uploads/Course/';
        if (!is_dir($rootPath)) {
            mkdir($rootPath);
        }
		$upload            =   new \Think\Upload();                 // 实例化上传类
	    $upload->maxSize   =   2097152 ;                            // 设置附件上传大小
	    $upload->exts      =   array('jpg', 'gif', 'png', 'jpeg');  // 设置附件上传类型
	    $upload->rootPath  =   $rootPath;                           // 设置附件上传根目录
	    $upload->autoSub   =   false;                               // 是否自动生成子目录
	   
        // 上传文件 
	    $info = $upload->upload();

        // 返回错误提示消息
	    if(!$info) { 
	        $this->ajaxReturn(get_ajax_res(0, '新增课程失败：'.$upload->getError()));
	    }

        // 获取文件名和路径
	    $imageName = $info['course_image']['savename'];
	    $imagePath = $rootPath.$imageName;

        // 将课程信息写入数据库
	    $courseModel->teacher_id   = session('UID');
        $courseModel->course_image = $imageName;
        $courseModel->create_time  = NOW_TIME;
        $courseModel->teacher_name  = session('truename');

        $courseModel->add();

        // 处理课程缩略图
        $imageObject = new \Think\Image(); 
        $imageObject->open($imagePath);
        $imageObject->thumb(100,100)->save($rootPath.$imageName);

        // 返回成功提示
        $this->ajaxReturn(get_ajax_res(1, '新增课程成功'));
	}

	public function homeworkAdd()
	{
		$this->display();
	}

	public function course()
	{	
		$courseDB = M('course');
        $courseList = $courseDB->where(array('teacher_id' => session('UID')))->field('id,course_name,course_image,course_about')->select();
		$this->assign('courseList',$courseList);
		$this->display();
	}

}