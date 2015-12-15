<?php
namespace Home\Controller;

use Think\Controller;

class WorksController extends Controller 
{   


    public function showWork()
    {
        $id = I('get.id');
        $db = M('works');
        $worksInfo = $db->where('id = '.$id)->find();
        $this->assign('worksInfo',$worksInfo);
        $this->display();
    }

    public function previewWork()
    {   
        $hid = I('get.id');
        $db = M('homework_list');
        $filePath = $db->where('homework_id = '.$hid)->getField('file_path');

        $dirName = basename($filePath,'.zip');
        $rootPath = './Uploads/Works/';
        $dirPath = $rootPath.$dirName;

        if (!is_dir($dirPath)) {
            $zipObject = new \ZipArchive;
            
            if ($zipObject->open($filePath) === TRUE) {
                $zipObject->extractTo($rootPath);
                $oldDirPath = $rootPath.$zipObject->getNameIndex(0);
                rename($oldDirPath, $dirPath);
                $zipObject->close();
            }
        }
 
       $this->redirect("/Home/Works/showWork", array('path' => $dirName));

    }

    public function OneKeyrRelease()
    {   
        // $this->ajaxReturn($_POST);
        // $this->ajaxReturn($_POST);
        $hid = I('post.homeworkId');
        $courseId = I('post.courseId');
        $title = I('post.title');
        $content = I('post.content');
        $worksModel = M('works');
        $userID = session('UID');
        $rootPath          =   './Uploads/Works/';
        $upload            =   new \Think\Upload();                 // 实例化上传类
        $upload->maxSize   =   2097152 ;                            // 设置附件上传大小
        $upload->exts      =   array('jpg', 'gif', 'png', 'jpeg');  // 设置附件上传类型
        $upload->rootPath  =   $rootPath;                           // 设置附件上传根目录
        $upload->autoSub   =   false;                               // 是否自动生成子目录
       
        // 上传文件 
        $info = $upload->upload();

        // 返回错误提示消息
        if(!$info) { 
            $this->ajaxReturn(get_ajax_res(0, '上传失败：'.$upload->getError()));
        }

        $imgFileName = $info['works_file']['savename'];
        $imgFilePath = $rootPath.$imgFileName;


        $imageObject  = new \Think\Image(); //实例化图片处理类
        
        $imageObject->open($imgFilePath);
        $imageObject->thumb(680,350,3)->save($rootPath.'b_'.$imgFileName);

        $imageObject->open($imgFilePath);
        $imageObject->thumb(265,272,3)->save($rootPath.'m_'.$imgFileName);

        $imageObject->open($imgFilePath);
        $imageObject->thumb(420, 420,3)->save($rootPath.'s_'.$imgFileName);

        $db = M('homework_list');
        $filePath = $db->where('homework_id = '.$hid)->getField('file_path');

        $dirName = basename($filePath,'.zip');
        $rootPath = './Uploads/Works/';
        $dirPath = $rootPath.$dirName;

        if (!is_dir($dirPath)) {
            $zipObject = new \ZipArchive;
            
            if ($zipObject->open($filePath) === TRUE) {
                $zipObject->extractTo($rootPath);
                $oldDirPath = $rootPath.$zipObject->getNameIndex(0);
                rename($oldDirPath, $dirPath);
                $zipObject->close();
            }
        }else{

        }

        $data = array(
            'works_name' => $title,
            'works_about' => $content,
            'works_pubtime' => NOW_TIME,
            'works_path' => $dirName,
            'works_image' => $imgFileName,
            'user_id'     => session('UID'),
            'works_author' => session('truename'),
            'homework_id' => $hid
        );

        // $this->ajaxReturn($data);

        $res = $worksModel->add($data);

        if ($res) {
            $countsDB   = M('works_counts');
            $countsData = array(
                'works_id' => $res
            );
            $countsDB->data($countsData)->add();
            $this->ajaxReturn(get_ajax_res(1, '作品发布成功'));
        }else{
            $this->ajaxReturn(get_ajax_res(0, '作品发布失败，请重试'));
        }
    }

    public function worksAddAction()
    {   
        if (!IS_POST) $this->error('非法请求',U('Index/index'));

        $worksModel = D('works');
        $res = $worksModel->create($_POST,4);

        if (!$res) {
            $this->ajaxReturn(get_ajax_res(0, '上传失败：'.$worksModel->getError()));
        }

        $userID = session('UID');
        $rootPath          =   './Uploads/Works/';
        if(!is_dir($rootPath))
        {
            mkdir($rootPath);
        }
        $upload            =   new \Think\Upload();                 // 实例化上传类
        $upload->maxSize   =   2097152 ;                            // 设置附件上传大小
        $upload->exts      =   array('jpg', 'gif', 'png', 'jpeg', 'zip');  // 设置附件上传类型
        $upload->rootPath  =   $rootPath;                           // 设置附件上传根目录
        $upload->autoSub   =   false;                               // 是否自动生成子目录
       
        // 上传文件 
        $info = $upload->upload();

        // 返回错误提示消息
        if(!$info) { 
            $this->ajaxReturn(get_ajax_res(0, '上传失败：'.$upload->getError()));
        }

        $zipFileName = $info[0]['savename'];
        $zipFilePath = $rootPath.$zipFileName;
        $zipDirName  = explode('.',$zipFileName);
        $zipDirName  = $zipDirName[0];
        $zipDirPath  = $rootPath.$zipDirName;

        $imgFileName = $info[1]['savename'];
        $imgFilePath = $rootPath.$imgFileName;

        // trace($zipFilePath,'提示','ERR');

        $zipObject = new \ZipArchive;
            
        if ($zipObject->open($zipFilePath) === TRUE) {
            $zipObject->extractTo($rootPath);
            $oldDirPath = $rootPath.$zipObject->getNameIndex(0);
            rename($oldDirPath, $zipDirPath);
            $zipObject->close();
        } else {
            unlink($zipFilePath);
            // $this->returnMessage('文件解压失败,请检查您上传的文件!');
        }
        $imageObject  = new \Think\Image(); //实例化图片处理类
        
        $imageObject->open($imgFilePath);
        $imageObject->thumb(680,350,3)->save($rootPath.'b_'.$imgFileName);

        $imageObject->open($imgFilePath);
        $imageObject->thumb(265,272,3)->save($rootPath.'m_'.$imgFileName);

        $imageObject->open($imgFilePath);
        $imageObject->thumb(420, 420,3)->save($rootPath.'s_'.$imgFileName);

        $worksModel->works_path   = $zipDirName;
        $worksModel->works_image  = $imgFileName;
        $worksModel->user_id      = $userID;
        $worksModel->works_author = session('truename');

        $res = $worksModel->add();
        trace($res,'提示','ERR');

        if ($res) {
            $countsDB   = M('works_counts');
            $countsData = array(
                'works_id' => $res
            );
            $countsDB->data($countsData)->add();
            $this->ajaxReturn(get_ajax_res(1, '作品发布成功'));
        }else{
            $this->ajaxReturn(get_ajax_res(0, '作品发布失败，请重试'));
        }
    } 

    public function s()
    {   
        $worksID = I('id');
        if (empty($worksID)) {
            $this->error('参数错误');
        }

        $worksDB = M('works');

        $worksInfo = $worksDB->where('vs_works.id = '.$worksID)
        ->field('vs_works.id,works_name,works_about,works_path,works_image,is_delete,vs_works.user_id,works_pubtime,comment,score')
        ->join('left join vs_homework_list as hl on vs_works.homework_id = hl.homework_id')
        ->find();

        // dump($worksInfo);exit;

       if (!$worksInfo) {
            $this->error('该作品不存在哦');
        }

        $userID = $worksInfo['user_id'];
        $userDB = M('user');
        $userInfo = $userDB->where('id = '.$userID)->field('truename,sign,avater_path')->find();

        $countsInfo = setCounts('click',$worksID,'click_counts');
        // var_dump($countsInfo);exit;

        $this->assign('worksInfo', $worksInfo);
        $this->assign('userInfo', $userInfo);
        $this->assign('countsInfo', $countsInfo);
        $this->display();
    }

    public function doCounts(){

        if(!IS_POST){
            $this->error('非法请求',U('Index/index'));
        }
        $userID = session('UID');
        if(empty($userID)){
            $this->ajaxReturn(get_ajax_res(0, '请先登录哦，亲'));
        }

        $operateID = I('post.oid');
        $worksID   = I('post.wid');
        // F()
        // $operateID = 2;
        // $worksID   = 20;

        $operateArr = array(
            1 => 'praise_counts',
            2 => 'collect_counts',
        );

        $operationDB = M('works_operation');

        $operatMap  = array(
            'works_id'    => $worksID,
            'user_id'     => session('UID'),
            'operate_id'  => $operateID,
        );

        $res = $operationDB->where($operatMap)->getField('is_operate');

        $countsDB = M('works_counts');
        $countsMap = array(
            'works_id' => $worksID
        );

        if ($res == '1'){
           setCounts('click',$worksID,$operateArr[$operateID],'-');
            $operationDB->where($operatMap)->setField('is_operate',0);
        }else{

            if ($res == '0') {
               setCounts('click',$worksID,$operateArr[$operateID],'+');
                $operationDB->where($operatMap)->setField('is_operate',1);
            }else{
                  $operatData = array(
                    'works_id'    => $worksID,
                    'user_id'     => session('UID'),
                    'operate_id'  => $operateID,
                    'operate_time' => NOW_TIME
                );
                $operationDB->data($operatData)->add();
                setCounts('click',$worksID,$operateArr[$operateID],'+');
            }      
        }
        $countsInfo = F('click-'.$worksID);
        $countsInfo = $countsInfo[$operateArr[$operateID]];
        $this->ajaxReturn(get_ajax_res(1, $countsInfo));
    }

    public function deleteWorks()
    {
        if (!IS_POST) $this->error('非法请求',U('Index/index'));

        $worksID = I('post.id');

        $worksDB = M('works');

        $res = $worksDB->where('id = '.$worksID)->setField('is_delete',1);

        if ($res) {
            $this->ajaxReturn(get_ajax_res(1, '作品删除成功'));
        }else{
            $this->ajaxReturn(get_ajax_res(0, '作品删除失败'));
        }
    }
    
    public function editWorks()
    {
        if (!IS_POST) $this->error('非法请求',U('Index/index'));

        $worksID    = I('post.id');
        $worksName  = I('post.works_name');
        $worksAbout = I('post.works_about');
        $worksLabel = I('post.works_label');

        $worksDB = M('works');
        $data = array(
            'works_name' => $worksName,
            'works_about' => $worksAbout,
            'works_label' => $worksLabel,
        );
        $res = $worksDB->where('id = '.$worksID)->save($data);

        if ($res) {
            $this->ajaxReturn(get_ajax_res(1, '编辑成功'));
        }else{
            $this->ajaxReturn(get_ajax_res(0, '编辑失败'));
        }
    }
  
    public function getEditWorksInfo()
    {
        if (!IS_POST) $this->error('非法请求',U('Index/index'));

        $worksID = I('post.id');

        $worksDB = M('works');

        $res = $worksDB->where('id = '.$worksID)->field('works_name,works_about,works_label')->find();

        $this->ajaxReturn($res);
    }

    public function deleteCollect()
    {
        if (!IS_POST) $this->error('非法请求',U('Index/index'));

        $operateID = I('post.oid');
        $worksID   = I('post.wid');

        $operationDB = M('works_operation');

        $res = $operationDB->where('id = '.$operateID)->setField('is_operate',0);

        if ($res) {
            $countsDB = M('works_counts');
            $countsMap = array(
                'works_id' => $worksID
            );
            $countsDB->where($countsMap)->setDec('collect_counts',1);
            $this->ajaxReturn(get_ajax_res(1, '取消成功'));
        }else{
            $this->ajaxReturn(get_ajax_res(0, '取消失败'));
        }
    }

}