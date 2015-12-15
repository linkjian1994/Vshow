<?php
namespace Home\Controller;

use Think\Controller;
use Org\Net;

class CourseController extends Controller 
{	
   
    
    // 教师课程管理
    public function t_index()
    {
        $courseID = I('get.courseId');
        
        if (empty($courseID)) {
            $this->error('参数错误');
        }
    
        $Course = M('course');
        $courseInfo = $Course->where(array('id' => $courseID))->field('course_name')->find();

        $courseCache = "$courseID-course-name";
        $courseName =  $courseInfo['course_name'];
   
        if (!F($courseCache)) {
            F($courseCache,$courseName);
        }

        $db     = M('course_notice');
        $mapArr = array('course_id' => $courseID);
        $fieldStr = 'id,title,teacher_name,pub_time';

        $count = $db->where($mapArr)->count();
        
        $Page = new \Think\Page($count, 10);
        $show       = $Page->show();
        $noticeList = $db->where($mapArr)->field($fieldStr)->limit($Page->firstRow.','.$Page->listRows)->select();
        // dump($noticeList);exit;
        $this->assign('courseName',$courseName);
        $this->assign('noticeList',$noticeList);
        $this->assign('page',$show);
        
        $this->display();
    }

    // 教师教学公告
    public function t_ShowNotice()
    {

    }

    // 教师发布公告
    public function t_pubNotice()
    {
        $rules = array(
            array('title','require','请填写问题标题'),
            array('title','1,24','问题标题在24个字符以内',0,'length'),
            array('content','require','请填写问题描述'),
            array('content','1,200','问题标题在200个字符以内',0,'length'),
            array('courseId','require','课程ID不存在')
        );

        $Notice = M("course_notice");

        if (!$Notice->validate($rules)->create()){
             exit($Notice->getError());
        }else{
            $Notice->teacher_name  = session('truename');
            $Notice->pub_time  = NOW_TIME;
            $res = $Notice->add();
            if ($res) {
                $this->ajaxReturn(get_ajax_res(1, '公告发布成功'));
            }else{
                $this->ajaxReturn(get_ajax_res(0, '公告发布失败，请稍后重试'));
            }
        }
    }

     // 教师互动交流
    public function t_ShowInterflow()
    {
        $courseId = I('get.courseId');
        if (empty($courseId)) {
            $this->error('参数错误');
        }

        $InterFlow = M('course_interflow');
        $map = array('course_id' => $courseId);
        $count = $InterFlow->where($map)->count();

        $Page = new \Think\Page($count, 10);

        $show = $Page->show();

        $interFlowList = $InterFlow->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('interFlowList',$interFlowList);
        $this->assign('courseName',F($courseId.'-course-name'));

        $this->assign('page',$show);

        $this->display();
    }

  
    public function t_ShowResource()
    {

        $courseId = I('get.courseId');
        if (empty($courseId)) {
            $this->error('参数错误');
        }

        $Resource = M('course_resource');
        $map = array('course_id' => $courseId);
        $count = $Resource->where($map)->count();

        $Page = new \Think\Page($count, 10);

        $show = $Page->show();

        $resourceList = $Resource->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('resourceList',$resourceList);
        $this->assign('courseName',F($courseId.'-course-name'));
        $this->assign('page',$show);

        $this->display();
    }

    public function t_PubResource()
    {
        if (!IS_POST) $this->error('非法请求',U('Index/index'));

        $courseId   = I('post.courseId');
        $title      = I('post.title');


        if (empty($courseId) || empty($title)) {
            $this->ajaxReturn(get_ajax_res(0, '上传文件失败：参数错误'));
        }

        $userID            = session('UID');
        $rootPath          =   "./Uploads/Course/$courseId/";

        if (!is_dir($rootPath)) {
            mkdir($rootPath);
        }

        $upload            =   new \Think\Upload();                 // 实例化上传类
        $upload->maxSize   =   20971520 ;                            // 设置附件上传大小
        $upload->exts      =   array('jpg', 'gif', 'png', 'jpeg', 'zip','psd');  // 设置附件上传类型
        $upload->rootPath  =   $rootPath;                           // 设置附件上传根目录
        $upload->autoSub   =   false;                               // 是否自动生成子目录
       
        // 上传文件 
        $info = $upload->upload();

        // 返回错误提示消息
        if(!$info) { 
            $this->ajaxReturn(get_ajax_res(0, '上传失败：'.$upload->getError()));
        }else{
            $file_size = round(($info['res_file']['size'])/(1024*1024),1).' m';
            $data = array(
                'title' => $title,
                'file_path' => $rootPath.$info['res_file']['savename'],
                'file_size' => $file_size,
                'teacher_name' => session('truename'),
                'user_id' => session('UID'),
                'course_id' => $courseId,
                'pub_time' => NOW_TIME
            );
            $Resource = M('course_resource');
            $Resource->add($data);
            $this->ajaxReturn(get_ajax_res(1, '上传成功'));
        }
    }

    public function t_ShowHomework()
    {   
        // exit;
        $courseId = I('get.courseId');
        
        if (empty($courseId)) {
            $this->error('参数错误');
        }

        $homeworkModel = M('course_homework');

        $mapArr    =  array('course_id' => $courseId);

        $homeworkList =  $homeworkModel->where($mapArr)->order('id desc')->select();
        // dump($homeworkList);exit;
        // dump($homeworkList);exit;
        $this->assign('homeworkList',$homeworkList);

        $this->assign('courseName',F($courseId.'-course-name'));
        $this->display();

    }

    public function t_HomeworkManage()
    {   
        $courseId = I('get.courseId');
        $homewokrId = I('get.homewokrId');
        
        if (empty($courseId) || empty($homewokrId)) {
            $this->error('参数错误');
        }

        $Homework  =  M('homework_list');
        $homeworkList = $Homework->where('homework_id = '.$homewokrId)->select();
        $this->assign('homeworkList',$homeworkList);
        $this->assign('courseName',F($courseId.'-course-name'));
        
        $this->display();
    }

    public function t_HomeworkScore()
    {
        $comment = I('post.comment');
        $score = I('post.score');
        $id = I('post.hid');

        $Homework = M('homework_list');
        $data = array(
            'comment' => $comment,
            'score'   => $score
        );
        $res = $Homework->where("id = $id")->save($data);

        if ($res) {
            $this->ajaxReturn(get_ajax_res(1, '作业评分成功'));
        }else{
            $this->ajaxReturn(get_ajax_res(0, '作业评分失败，请重试'));
        }
    }

  /*  public function t_PreviewHomework()
    {
        $this->
    }*/


    public function downloadAllHomework()
    {   
        $homeworkId = I('get.homeworkId');
        $courseId   = I('get.courseId');
        
        if (empty($homeworkId) || empty($courseId)) {
            $this->error('参数错误');
        }

        $zipObject = new \ZipArchive();
        
         $homeworkDir = "./Uploads/Course/{$courseId}/homework/{$homeworkId}/";
        
        if ($handle = opendir($homeworkDir)) {
            $allHomework = "{$homeworkDir}course$courseId$homewokrId.zip";

            $zipObject->open($allHomework, $zipObject::CREATE); 

            /* 这是正确地遍历目录方法 */
            while (false !== ($file = readdir($handle))) {
                if ($file == '.' || $file == '..' ) {
                    continue;
                }
             
                $zipObject->addFile("{$homeworkDir}$file", "$file");
            }

            closedir($handle);

            \Org\Net\Http::download($allHomework);
        }
    }

    public function s_Index()
    {   
        $courseID = I('get.courseId');
        
        if (empty($courseID)) {
            $this->error('参数错误');
        }
        $Course = M('course');
        $courseInfo = $Course->where(array('course_id' => $courseID))->field('course_name')->find();

        $courseCache = "$courseID-course-name";
        $courseName =  $courseInfo['course_name'];

        if (!F($courseCache)) {
            F($courseCache,$courseName);
        }


        $db     = M('course_notice');
        $mapArr = array('course_id' => $courseID);
        $fieldStr = 'id,title,teacher_name,pub_time';

        $count = $db->where($mapArr)->count();
        
        $Page = new \Think\Page($count, 10);
        $show       = $Page->show();
        $noticeList = $db->where($mapArr)->field($fieldStr)->limit($Page->firstRow.','.$Page->listRows)->select();
        // dump($noticeList);exit;
        $this->assign('courseName',$courseName);
        $this->assign('noticeList',$noticeList);
        $this->assign('courseName',F($courseID.'-course-name'));

        $this->assign('page',$show);
        
        $this->display();

    }
      // 学生发布交流
    public function s_PubtInterflow()
    {
        // $this->ajaxReturn($_POST);

        $rules = array(
            array('title','require','请填写问题标题'),
            array('title','1,24','问题标题在24个字符以内',0,'length'),
            array('content','require','请填写问题描述'),
            array('content','1,200','问题标题在200个字符以内',0,'length'),
            array('courseId','require','课程ID不存在')
        );

        $InterFlow = M("course_interflow");
        if (!$InterFlow->validate($rules)->create()){
             exit($InterFlow->getError());
        }else{
            $InterFlow->parent_id = 0;
            $InterFlow->truename  = session('truename');
            $InterFlow->user_id   = session('UID');
            $InterFlow->pub_time  = NOW_TIME;
            $res = $InterFlow->add();

             if ($res) {
                $this->ajaxReturn(get_ajax_res(1, '问题发布成功'));
            }else{
                $this->ajaxReturn(get_ajax_res(0, '问题发布失败，请稍后重试'));
            }
        }
    }
 // 学生教学公告
    public function s_ShowNoticeInfo()
    {
        $noticeId = I('get.noticeId');
        if (empty($noticeId)) {
            $this->error('参数错误');
        }

        $db = M('course_notice');
        $mapArr = array('id' => $noticeId);
        $fieldStr = 'id,title,content,pub_time';
        $noticeInfo = $db->where($mapArr)->field($fieldStr)->find();
        
        if ($noticeInfo) {
            $this->assign('noticeInfo',$noticeInfo);
            $this->display();
        }else{
            $this->error('文章不存在');
        }

    }
    // 学生互动交流
    public function s_ShowInterflow()
    {   
        // dump($_SESSION);exit;
        $courseId = I('get.courseId');
        if (empty($courseId)) {
            $this->error('参数错误');
        }

        $InterFlow = M('course_interflow');
        $map = array('course_id' => $courseId);
        $count = $InterFlow->where($map)->count();

        $Page = new \Think\Page($count, 10);

        $show = $Page->show();

        $interFlowList = $InterFlow->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('interFlowList',$interFlowList);
        $this->assign('courseName',F($courseId.'-course-name'));

        $this->assign('page',$show);

        $this->display();
    }

   

    // 学生查看交流详细信息
    public function s_ShowInterFlowInfo()
    {
        $courseId = I('get.courseId');
        $interId  = I('get.interId');

        if (empty($courseId) || empty($interId)) {
            $this->error('参数错误');
        }

        $Interflow = M('course_interflow');

        $interFlowInfo = $Interflow->where(array('id' => $interId))->find();

        $this->assign('interFlowInfo',$interFlowInfo);
        $this->display();
    }


    // 学生查看资源
    public function s_ShowResource()
    {
        $courseId = I('get.courseId');
        if (empty($courseId)) {
            $this->error('参数错误');
        }

        $Resource = M('course_resource');
        $map = array('course_id' => $courseId);
        $count = $Resource->where($map)->count();

        $Page = new \Think\Page($count, 10);

        $show = $Page->show();

        $resourceList = $Resource->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('resourceList',$resourceList);
        $this->assign('page',$show);
        $this->assign('courseName',F($courseId.'-course-name'));


        $this->display();
    }

   

	public function s_ShowHomework()
	{	
		// exit;
		$courseID = I('get.courseId');
        
        if (empty($courseID)) {
            $this->error('参数错误');
        }

        $homeworkModel = M('course_homework');

        $mapArr    =  array('ch.course_id' => $courseID);
        $fieldStr  =  'ch.*,hl.id as is_submit,';
        $fieldStr .=  'unix_timestamp() > homework_expires as is_expires';
        $joinStr   =  'vs_homework_list as hl on hl.homework_id = ch.id ';

        $homeworkList =  $homeworkModel->alias('ch')->where($mapArr)->join($joinStr,'LEFT')->field($fieldStr)->order('id desc')->select();
     	// dump($homeworkList);exit;
        $this->assign('homeworkList',$homeworkList);
        $this->assign('courseName',F($courseID.'-course-name'));

        $this->display();

	}

	public function s_ShowHomeworkInfo()
	{
		$homeworkId = I('get.homeworkId');
		$courseId   = I('get.courseId');
        
        if (empty($homeworkId) || empty($courseId)) {
            $this->error('抱歉,参数错误');
        }

        $homeworkModel = M('course_homework');

        $mapArr    =  array('id' => $homeworkId);
        $fieldStr  =  'id,homework_name,teacher_name,homework_expires,homework_about,pub_time';

        $homeworkInfo =  $homeworkModel->where($mapArr)->field($fieldStr)->find();
     	
        $this->assign('homeworkInfo',$homeworkInfo);

        $this->display();

	}

    public function s_PubHomework()
    {   
        if (!IS_POST) $this->error('非法请求',U('Index/index'));

        $homeworkId = I('post.homeworkId');
        $courseId   = I('post.courseId');

        if (empty($homeworkId) || empty($courseId)) {
            $this->ajaxReturn(get_ajax_res(0, '上传作业失败：参数错误'));
        }

        $userID            = session('UID');
        $rootPath          =   "./Uploads/Course/$courseId/homework/$homeworkId/";

        if (!is_dir($rootPath)) {
            mkdir($rootPath,0777,true);
        }

        if (!is_dir($rootPath)) {
            mkdir("./Uploads/Course/$courseId/homework/");
            mkdir($rootPath);
        }

        $upload            =   new \Think\Upload();                 // 实例化上传类
        $upload->maxSize   =   20971520 ;                            // 设置附件上传大小
        $upload->exts      =   array('jpg', 'gif', 'png', 'jpeg', 'zip','psd');  // 设置附件上传类型
        $upload->rootPath  =   $rootPath;                           // 设置附件上传根目录
        $upload->autoSub   =   false;                               // 是否自动生成子目录
       
        // 上传文件 
        $info = $upload->upload();

        // 返回错误提示消息
        if(!$info) { 
            $this->ajaxReturn(get_ajax_res(0, '上传失败：'.$upload->getError()));
        }

        $fileName = $info['homework_file']['savename'];
        $filePath = $rootPath.$fileName;

        $homeworkDB = M('course_homework');
        $isExpires = $homeworkDB->where(array('id' => $homeworkId))
        ->field('unix_timestamp() > homework_expires as is_expires')
        ->find();

        if ($isExpires == 0) {
            $this->ajaxReturn(get_ajax_res(0, '作业提交失败：已超过截止时间'));
        }

        $db = M('homework_list');

        $data = array(
            'homework_id' => $homeworkId,
            'course_id'   => $courseId,
            'user_id' => $userID,
        );
        $isSubmit = $db->where($data)->getField('id');
        if ($isSubmit > 0) {
            $data['file_path'] = $filePath;

            $res = $db->where(array('id' => $isSubmit))->save($data);

            if ($res) {
                $this->ajaxReturn(get_ajax_res(1, '作业修改成功'));
            }else{
                $this->ajaxReturn(get_ajax_res(0, '作业修改失败'));
            }

        }else{
            $data['file_path'] = $filePath;
            $data['user_name'] = session('truename');
            $data['pub_time']  = NOW_TIME;
            $res = $db->data($data)->add();

            if ($res) {
                $this->ajaxReturn(get_ajax_res(1, '作业提交成功'));
            }else{
                $this->ajaxReturn(get_ajax_res(0, '作业提交失败'));
            }
        }
       
    } 

	public function addCourse()
	{  
        if (!IS_POST) $this->error('非法请求',U('Index/index'));

		$courseModel = D('course');
        $res = $courseModel->create($_POST,4);
        if (!$res) {
            $this->ajaxReturn(get_ajax_res(0, '新增课程失败：'.$courseModel->getError()));
        }

        $rootPath          =   './Uploads/Course/';
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
	    $courseModel->create_teacher_id = session('UID');
        $courseModel->course_image      = $imageName;

        $courseModel->add();

        // 处理课程缩略图
        $image = new \Think\Image(); 
        $image->open($imagePath);
        $image->thumb(100,100)->save($imageName.'thumb.'.$image->type());

        // 返回成功提示
        $this->ajaxReturn(get_ajax_res(1, '新增课程成功'));
	}

	public function addHomework()
	{	

		if (!IS_POST) $this->error('非法请求',U('Index/index'));
		
        // 添加字段
		$_POST['pub_time']         =  NOW_TIME;
		$_POST['homework_expires'] =  strtotime($_POST['homework_expires']);

        // 动态自动验证规则
		$rules = array(
			array('homework_name','require','请填写课程作业名称',0,'',6), 
			array('homework_name','0,12','作业名称在12个字符以内',0,'length',6),
			array('homework_about','require','请填写作业要求',0,'',6), 
			array('homework_about','0,200','作业要求在200个字符以内',0,'length',6),
			array('homework_expires','require','请选择截止时间',0,'',6)
		);


		$db = M('course_homework');
        
        // 进行自动验证
        $res = $db->validate($rules)->create();

        // 验证失败：返回错误信息
 		if (!$res) {
            $this->ajaxReturn(get_ajax_res(0, '添加作业失败：'.$db->getError()));
        }

        // 将作业信息添加到数据库
        $res = $db->add();

        // 返回成功信息
        if ($res) {
          $this->ajaxReturn(get_ajax_res(1, '添加作业成功'));
        }
	}

    // 学生提交作业


}

