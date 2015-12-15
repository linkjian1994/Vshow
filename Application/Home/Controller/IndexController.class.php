<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller 
{
    public function index()
    {      
        // 检测cookie
        $UID = session('UID');
        
        if (empty($UID)) {
            if (!empty($_COOKIE['UID'])) {
                session('UID',$_COOKIE['UID']);
                session('avaterPath',$_COOKIE['avaterPath']);
            }
        }

        $worksDB  = M('works');

        // 取推荐作品
        $mapArr      = array('is_delete' => 0,'is_rec' => 0);
        $fieldStr    = 'id,works_name,works_image';
        $recWorkList = $worksDB->where($mapArr)->field($fieldStr)->limit(0,5)->select();
       
  
        // 取点击最高作品
        $mapArr      = array('is_delete' => 0);
        $fieldStr    = 'vs_works.id,works_author,click_counts,works_name'; 
        $joinStr     = 'vs_works_counts as c on c.works_id = vs_works.id';
        $maxWorkList = $worksDB->where($mapArr)->field($fieldStr)->join($joinStr)->order('click_counts desc')->limit(0,9)->select();
        
        // 取最新作品
        $mapArr      = array('is_delete' => 0,'is_rec' => 0);
        $fieldStr    = 'id,works_author,works_name'; 
        $newWorkList = $worksDB->where($mapArr)->field($fieldStr)->order('works_pubtime desc')->limit(9)->select();

        // 取最热作品 
        // dump($maxWorkList);exit;
        // $fieldStr     = 'w.id,works_name,works_author,works_pubtime,works_image,avater_path,';
        // $fieldStr    .= 'praise_counts,collect_counts,comment_counts,click_counts'; 
        // $jointoCounts = 'vs_works_counts as c on w.id = c.works_id';
        // $jointoUser   = 'vs_user as u on u.id =w.user_id ' ;
        // $hotWorkList  = $worksDB->alias('w')->where(array('is_delete' => 0))->field($fieldStr)->join($jointoCounts)->join($jointoUser)->limit(4)->select();
        
        // 取作品展示
        $fieldStr     = 'w.id,works_name,works_author,works_pubtime,works_image,avater_path,';
        $fieldStr    .= 'praise_counts,collect_counts,comment_counts,click_counts'; 
        $jointoCounts = 'vs_works_counts as c on w.id = c.works_id';
        $jointoUser   = 'vs_user as u on u.id =w.user_id ' ;
        $showWorkList  = $worksDB->alias('w')->where(array('is_delete' => 0))->field($fieldStr)->join($jointoCounts)->join($jointoUser)->order('id')->limit(8)->select();
        
        $this->assign('recWorkList',$recWorkList);
        $this->assign('maxWorkList',$maxWorkList);
        $this->assign('newWorkList',$newWorkList);
        // $this->assign('hotWorkList',$hotWorkList);
        $this->assign('showWorkList',$showWorkList);


    	$this->display();
    }

    // 作品列表页
    public function workList()
    {   
        $key = I('get.key');

        // 获取查询关键字
        if (IS_GET && $key) {
            $map  = ' works_name   like "%'.$key.'%"';
            $map .= ' OR works_author like "%'.$key.'%"';
            $map .= ' AND is_delete = 0';
        }else{
            $map = array('is_delete' => 0);
        }

        // 进行分页
        $worksDB      = M('works');

        $counts = $worksDB->where(array('is_delete' => 0))->count();

        $Page         = new \Think\VshowPage($counts,8);
        $show         = $Page->show();

        $fieldStr     = 'w.id,works_name,works_author,works_pubtime,works_image,avater_path,';
        $fieldStr    .= 'praise_counts,collect_counts,comment_counts,click_counts'; 
        $jointoCounts = 'vs_works_counts as c on w.id = c.works_id';
        $jointoUser   = 'vs_user as u on u.id =w.user_id ' ;
        $allWorkList  = $worksDB->alias('w')->where($map)->field($fieldStr)->join($jointoCounts)->join($jointoUser)->limit($Page->firstRow.','.$Page->listRows)->select();
        
        $this->assign('page',$show);
        $this->assign('allWorkList',$allWorkList);

        $this->display();
    }

    // AJAX获取分页排序结果
    public function getWorkList()
    {   

        // 根据用户的选择，动态获取分页排序
        $type = I('post.t');
        $sort = I('post.s');
        $page = I('post.p');

        $_GET['p'] = $page;

        $sortMap = array(
            'sort-new'  =>  'works_pubtime', 
            'sort-hot'  =>  'click_counts',
            'sort-col'  =>  'collect_counts',
            'sort-prc'  =>  'praise_counts',
        );

        $worksDB      = M('works');

        $counts = $worksDB->where(array('is_delete' => 0))->count();

        $Page         = new \Think\VshowPage($counts,8);
        $show         = $Page->show();

        $fieldStr     = 'w.id,works_name,works_author,works_pubtime,works_image,avater_path,';
        $fieldStr    .= 'praise_counts,collect_counts,comment_counts,click_counts'; 
        $jointoCounts = 'vs_works_counts as c on w.id = c.works_id';
        $jointoUser   = 'vs_user as u on u.id =w.user_id ' ;
        $allWorkList  = $worksDB->alias('w')->where(array('is_delete' => 0))
                                ->field($fieldStr)
                                ->join($jointoCounts)
                                ->join($jointoUser)
                                ->limit($Page->firstRow.','.$Page->listRows)
                                ->order($sortMap[$sort].' DESC')
                                ->select();
       $this->ajaxReturn($allWorkList); 

    }

    // 学习资源
    public function learning()
    {
        $this->display();
    }

    // 留言板
    public function message()
    {
        $this->display();
    }
}