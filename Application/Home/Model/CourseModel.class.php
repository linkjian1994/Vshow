<?php
namespace Home\Model;
use Think\Model;
class CourseModel extends Model {
	protected $_auto = array(
		array('create_time','time','4','function'),
	);

	protected $_validate = array(
		array('course_name','require','请填写课程名称',0,'',4), 
		array('course_name','0,12','课程名称在12个字符以内',0,'length',4),
		array('course_about','require','请填写课程简介',0,'',4), 
		array('course_about','0,200','课程名称在200个字符以内',0,'length',4),
	);

}