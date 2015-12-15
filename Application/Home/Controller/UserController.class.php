<?php
namespace Home\Controller;

use Think\Controller;

class UserController extends Controller 
{
    public function test()
    {   
        // debug 用于查看SESSION
    	echo session('UID');
        // echo C('UPLOADS_PATH');

    }

    public function login()
    {   
        // 已登录的跳转到个人中心
        $userID  = session('UID');
        if ($userID) {
            $groupID = session('group_id');
            if ($groupID) {
                if ($groupID == 2) {
                    $this->redirect('TeacherCenter/index');  
                }else{
                    $this->redirect('StudentCenter/index');
                }
             }
        }
        
        $this->display();
    }

    public function doLogin()
    {   
        if (!IS_POST) $this->error('非法请求',U('Index/index'));
        
        // 实例化Model,进行自动验证
        $userModel = D('User');
        $res = $userModel->create($_POST,4);

        // 返回信息
        if ($res) {
          /*  if (session('group_id') == 2) {
                $this->redirect('TeacherCenter/index');   
            }else{
                $this->redirect('StudentCenter/index');
            }*/
            $this->ajaxReturn(get_ajax_res(1,'登录成功'));
        }else{
            $this->ajaxReturn(get_ajax_res(0, $userModel->getError()));
        }
    }
    
    public function logout()
    {
        if (session('UID')) {
            session(null);
        }

        if (cookie('UID')) {
            cookie('UID',null);
            cookie('avaterPath',null);
        }

        $this->redirect('Index/index');
    }

    public function userReg()
    {
      $this->display();
    }

    public function modifyPwd()
    {   
       if (!IS_POST) $this->error('非法请求',U('Index/index'));

       // 实例化Model,进行自动验证
       $User = D('User');
       $res = $User->create($_POST,6);

       if ($res) {
            $this->ajaxReturn(get_ajax_res(1, '密码更改成功，请重新登录。即将跳转至登录页面'));
       }else{
            $this->ajaxReturn(get_ajax_res(0, $User->getError()));
       }
    }

   
    public function doRegister()
    {   
        if (!IS_POST) $this->error('非法请求',U('Index/index'));

        // 实例化Model,进行自动验证
    	$User = D('User');
    	$regData = $User->create($_POST,5);

        // 验证失败，返回错误信息，否则进行注册
    	if (false === $regData) {
		 	$this->ajaxReturn(get_ajax_res(0, $User->getError()));
		}else{
			// 添加用户信息到用户表
			$userID = $User->add();

            // 设置用户所属组
            $db  = M('auth_group_access');
            $res = $db->data(array('uid' => $userID,'group_id' => 3))->add();

            if (!$userID && !$res) {
                $this->ajaxReturn(get_ajax_res(0, '注册失败，请重试'));
            }

            // 生成随机token，用于账号激活
            // 生成随机字符串
			$strObj = new \Org\Util\String();
			$randString = $strObj::randString();

            // 获取当前时间戳
			$time = time();

            // 用户ID + 随机字符串 + 当前时间，组成验证token
			$token = md5($userID . $randString . $time);

            // 设置过期时间
			$tokenExpiry = time()+(3600 * 24);

            // 写入Token到数据库
			$userModel = M('user');
			$tokenData = array('token_code' => $token, 'token_expiry' => $tokenExpiry);
			$res = $userModel->where('id='.$userID)->setField($tokenData);

            // 返回错误信息或发送激活邮件
			if ($res === false) {
                $this->ajaxReturn(get_ajax_res(0, '注册失败，请重试或联系管理员'));
			}else{
                // 拼接激活邮件
				$content  = '<p>感谢你注册Vshow，请在24小时内点击以下链接完成注册，'; 
                $content .= '如果点击无效，请手动复制到地址栏打开。</p>';
				$content .= '<p>http://'.$_SERVER['SERVER_NAME'].__ROOT__.'/Home/';
                $content .= 'User/activate?token='.$token.'</p>';

                // 发送激活邮件到用户邮箱
				$res = sendMail($regData['email'],'激活你的Vshow账号',$content);

                // 返回操作提示
				if ($res) {
					$data['status'] = 1;
					$data['msg']	= '注册成功，激活邮件已发往你的注册邮箱'.$regData['email'].'请前往激活';
					$this->ajaxReturn($data);
				}else{
					$data['status'] = 0;
					$data['msg']	= '注册失败，请重新填写邮箱或联系管理员';
					$this->ajaxReturn($data);
				}
			}
		}
    }

      /* AJAX 班级联动 */
    public function getClass(){
    	if (!IS_POST) {
			$this->error('非法请求',U('Index/index'));
		}

		$selectType  = I('post.selectType');
		$selectValue = I('post.selectValue');

		if ($selectType == 'department') {
			$table = 'specialty';
		}else{
			$table = 'class';
		}

		$model = M($table);
		$res = $model->where(array('parentid' => $selectValue))->select();

		$this->ajaxReturn($res);
    }

    /* 获取验证码 */
    public function getVerifyCode(){
    	$codeConfig = array(
    		'fontSize' => '14',
    		'length'   =>  '4',
    		'useCurve' =>  false,
    		'useNoise' =>  false,
    		'imageH'   =>  '33',
    	);

		$Verify = new \Think\Verify($codeConfig);
    	$Verify->entry();
    } 

    // 配合前端validate,进行唯一性验证
    public function checkFieldUnqiue(){
        if (!IS_POST) $this->error('非法请求',U('Index/index'));
        
    	$validateValue = I('post.fieldValue'); 
		$validateID    = I('post.fieldId'); 

		$arrayToJs    = array(); 
		$arrayToJs[0] = $validateID;

		$userModel = M('user');
		$res       = $userModel->where(array($validateID => $validateValue))
                               ->field('id')
                               ->find();
		if ($res) {
			$arrayToJs[1] = false;		
		}else{
			$arrayToJs[1] =true;
		}

		$this->ajaxReturn($arrayToJs);
    }

    // 验证邮箱激活
    public function activate(){
        if (!IS_GET) $this->error('非法请求',U('Index/index'));

    	$token = I('get.token');

    	if (!empty($token)) {
            // 根据token查询用户信息
    		$userModel = M('user');
    		$map = array('token_code' => $token);
    		$info = $userModel->where($map)->field('id,token_expiry,status')->find();
            
            // token不存在，返回错误信息
    		if (!$info) {
    			$this->error('激活链接有误，请检查',U('Index/index'));
    		}

            // 账号已激活，返回信息
    		if ($info['status'] == 1) {
    			$this->success('该账号已激活，链接已失效',U('Index/index'));
    		}

            // 判断激活码是否过期
    		if ($info['token_expiry'] && time() < $info['token_expiry']) {
    			$res = $userModel->where($map)->setField(array('status' => '1'));

    			if ($res) {
                    $userDIR = C('USER_PATH').'u'.$info['id'].'/';
                    // echo $userDIR;exit;
                    if (!is_dir($userDIR)) {
                        mkdir($userDIR);
                    }
    				$this->success('激活成功，该账号可以登录了',U('Index/index'));
    			}else{
    				$this->error('激活失败，请联系管理员',U('Index/index'));
    			}

    		}else{
    			$this->error('激活失败，链接已失效，请重新注册', U('User/register'));
    		}

    	}else{
    		$this->error('激活失败，请联系管理员',U('Index/index'));
    	}
    }

    // 设置头像
    public function modifyAvater()
    {   
        if (!IS_POST) $this->error('非法请求',U('Index/index'));

        // 获取用户设置的头像坐标
        $coordsW = I('post.coords_w');
        $coordsH = I('post.coords_h');
        $coordsX = I('post.coords_x');
        $coordsY = I('post.coords_y');

        // 获取图片缩放后宽高
        $imagesW = intval(I('post.images_w'));
        $imagesH = intval(I('post.images_h'));

        // 设置上传参数
        $rootPath           =   './Uploads/Avater/';
        $upload             =   new \Think\Upload();                // 实例化上传类
        $upload->maxSize    =   2097152 ;                           // 设置附件上传大小
        $upload->exts       =   array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
        $upload->rootPath   =   $rootPath;                          // 设置附件上传根目录
        $upload->autoSub    =   false;                              // 是否自动创建子目录
     
        $info   =   $upload->upload();
        
        // 上传错误提示错误信息
        if(!$info) {
            $this->ajaxReturn(get_ajax_res(0, '头像上传失败：'.$upload->getError()));
        }

        // 获取头像图片信息
        $avaterName  = $info['avater']['savename'];
        $avaterPath  = $rootPath.$avaterName;

        // 进行图像裁剪
        $imageObj    = new \Think\Image(); 
        $res         = $imageObj->open($avaterPath);

        // 设置临时图像路径和新头像路径
        $imageType     = $imageObj->type();
        $tempAvater    = $rootPath.'avater_temp.'.$imageType; 
        $newAvaterName = $avaterName.'_thubm.'.$imageType; 
        $newAvater     = $rootPath.$newAvaterName;

        // 先生成临时头像缩略图
        $imageObj->thumb($imagesW,$imagesH)->save($tempAvater);
        $imageObj->open($tempAvater);

        // 后进行头像裁剪
        $res = $imageObj->crop($coordsW,$coordsH,$coordsX,$coordsY)->save($newAvater);

        if ($res) {
            // 成功后删除原图片和临时图片
            unlink($avaterPath);
            unlink($tempAvater);

            $userDB = M('user');
            $map  = array('id' => session('UID'));
            $data = array('avater_path' => $newAvaterName); 
            $res = $userDB->where($map)->setField($data);
            if ($res) {
                session('avaterPath',$newAvaterName);
            }
            $this->ajaxReturn(get_ajax_res(1, '头像上传成功'));
        }else{
            $this->ajaxReturn(get_ajax_res(0, '头像上传失败，请重试'));
        }
    }

    public function editSign()
    {
        if (!IS_POST) $this->error('非法请求',U('Index/index'));

        $userModel = D('user');

        $res = $userModel->create($_POST, 7);
        if ($res) {
            $userModel->where(array('id' => session('UID')))->save();
            $this->ajaxReturn(get_ajax_res(1, '签名修改成功'));
        }else{
            $this->ajaxReturn(get_ajax_res(0, '签名修改失败:'.$userModel->getError()));
        }
    }

    public function getPassword()
    {   
        if (!IS_POST) $this->error('非法请求',U('Index/index'));

        $userModel = D('user');

        $res = $userModel->create($_POST, 8);

        if ($res) {
            $strObj = new \Org\Util\String();
            $randString = $strObj::randString();
            $map = array(
                'username' => $userModel->username,
                'email'    => $userModel->email    
            );
            $res = $userModel->where($map)->setField('password',md5($randString));
            if ($res) {
                $content  = '<p>系统已为您自动生成随机密码，请使用该密码登陆个人中心后进行密码更改'; 
                $content .= '<p>您的新密码：<span class="color:red">'.$randString.'</span></p>';
                
                $res = SendMail($userModel->email,'Vshow重设你的密码',$content);
                if ($res) {
                    $this->ajaxReturn(get_ajax_res(1, '系统已为您自动生成随机密码，请登陆邮箱查收'));
                }else{
                    $this->ajaxReturn(get_ajax_res(0, '重设密码失败，请联系管理员'));
                }
            }   
            
        }else{
            $this->ajaxReturn($userModel->getError());
        }
    } 
}