<?php
 /**
 *  
 *
 */
namespace Home\Controller;

use Think\Controller;

class StudentCenterController extends Controller 
{

    // 权限认证
    public function _initialize()
    {   
    	// A('Admin/Common');
    }

    // 学生个人中心首页
    public function index()
    {	
        
        $userID = session('UID');
     
        if (!session('sign')) {
            $userDB = M('user');
            $map    = array('id' => $userID);
            $field  = 'sign';
            $user   = $userDB->where($map)->field($field)->find();

            if ($user) {
                session('sign',$user['sign']);
            }
        } 

        $this->display();
    }

    // 作品上传页
    public function upload()
    {   
        $this->display();     
    } 

    public function course()
    {   
        $courseModel = M('course');
        $fieldStr    = 'vs_course.id,course_name,course_about,course_pv,course_image,teacher_name';
        
        $Student = M('course_student');
        $idList = $Student->where('user_id='.session('UID'))->getField('course_id',true);

        $idList = implode(',', $idList);
   
        if ($idList) {
            $courseList  = $courseModel->where("id  in ($idList)")->field($fieldStr)->select(); 
        }

        $String = new \Org\Util\String();
        $nums = count($courseList);
        for ($i=0; $i <$nums ; $i++) { 
            $courseAbout = $courseList[$i]['course_about'];
            if (iconv_strlen($courseAbout,'utf-8')>=60) {
                $courseList[$i]['course_about'] = $String::msubstr($courseAbout,0,60);
            }
        }

        $fieldStr    = 'id,course_name,course_about,course_pv,course_image,teacher_name';
        $course  = $courseModel->field($fieldStr)->select();

       
        $this->assign('course',$course);
        $this->assign('courseList',$courseList);
        $this->display();     
    } 

    public function collect()
    {  
        $userID         =    session('UID');
        $worksDB        =    M('works');
        $fieldStr       =    'w.id, o.id as oid,works_name,works_author,operate_time,works_image';  
        $joinStr        =    'vs_works_operation as o on o.works_id = w.id';
        $mapStr         =    "o.user_id = $userID and operate_id = 2 and is_operate = 1";
        $collectList    =    $worksDB->alias('w')->where($mapStr)->field($fieldStr)->join($joinStr)->select();
      
        $this->assign('collectList',$collectList);
        $this->display();   
    }

    public function homework()
    {   
        $userID     =   session('UID');
        $worksDB    =   M('works');
        $worksMap   =   array('user_id' => $userID, 'is_delete' => 0);
        $worksField =   'id,works_name,works_pubtime,works_image';
        $workList   =   $worksDB->where($worksMap)->field($worksField)->select();

        $this->assign('workList',$workList );

        $this->display();
    }
	
    public function publishWorks()
    {
        $this->display();
    }

    public function getUserHomework()
    {   
        // if (!IS_POST) $this->error('非法请求',U('Index/index'));
        $courseID = I('get.courseID');
        
        if (empty($courseID)) {
            $this->error('参数错误');
        }

        $homeworkModel = M('course_homework');

        $mapArr    =  array('course_id' => $courseID);
        $fieldStr  =  'vs_course_homework.id id,homework_id,homework_name,homework_expires,homework_about';
        $fieldStr .=  ',pub_time,unix_timestamp() > homework_expires as is_expires';
        $joinStr   =  'vs_works on vs_works.homework_id = ';
        $joinStr  .=  'vs_course_homework.id';

        $homeworkList =  $homeworkModel->where($mapArr)->join($joinStr,'LEFT')->field($fieldStr)->select();

        $this->assign('homeworkList',$homeworkList);
        $this->display();
    } 

    public function submitUserHomework()
    {
        $homeworkID = I('get.hid');
        if (empty($homeworkID)) {
            $this->error('参数错误');
        }

        $this->assign('homeworkID',$homeworkID);
        $this->display();
    }
    
    public function takeCourse()
    {     

        $courseModel = M('course');

        $fieldStr    = 'id,course_name,course_about,course_pv,course_image,teacher_name';

        $courseList  = $courseModel->field($fieldStr)->select();

        $this->assign('courseList',$courseList);
        $this->display();
    }

    public function takeCourseAction()
    {   
        if (!IS_POST) $this->error('非法请求',U('Index/index'));

        $courseID = I('post.courseID');

        if (empty($courseID)) {
            $this->ajaxReturn(get_ajax_res(0, '参加课程失败：错误的操作'));
        }

        $courseStudentModel = M('courseStudent');

        $map = array(
            'course_id' => $courseID, 
            'user_id'   =>  session('UID'), 
        );

        $res =$courseStudentModel->where($map)->find();

        if ($res) {
            $this->ajaxReturn(get_ajax_res(0, '参加课程失败：你加入本课程'));
        }

        $data =  array(
            'course_id' => $courseID,
            'user_id'   => session('UID'),
            'add_time'  => NOW_TIME
        );

        $res  = $courseStudentModel->data($data)->add();

        if ($res) {
            $this->ajaxReturn(get_ajax_res(1, '恭喜，参加课程成功！'));
        }else{
            $this->ajaxReturn(get_ajax_res(0, '参加课程失败：请重试！'));
        }
    	
	}
}
