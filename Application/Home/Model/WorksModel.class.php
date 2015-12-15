<?php
namespace Home\Model;
use Think\Model;
class WorksModel extends Model {
    protected $_auto = array(
        array('works_pubtime','time','4','function'),
    );

    protected $_validate = array(
        array('works_name','require','请填写作品名称',0,'',4), 
        array('works_name','0,24','作品名称在24个字符以内',0,'length',4),

        array('works_about','require','请填写作品简介',0,'',4), 
        array('works_about','0,200','作品简介在200个字符以内',0,'length',4),

        array('works_label','0,24','作品标签在24个字符以内',0,'length',4),
    );

}