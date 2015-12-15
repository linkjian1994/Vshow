<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vshow-秀出自我</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="Vshow学生发布平台,提供学生的作品发布">
    <meta name="keywords" content="Vshow,致力于发展为高校的学生作品发布平台">
    <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Common/buttons.css"> 
    <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Plug/Validation-Engine/validationEngine.jquery.css">
    <link rel="stylesheet" type="text/css" href="/vshow/Public/script/Plug/artDialog/css/ui-dialog.css">
    <link rel="stylesheet" href="/vshow/Public/script/Plug/jcrop/css/jquery.Jcrop.css">
  
    <link rel="stylesheet" type="text/css" href="/vshow/Public/style/StudentCenter/ucenter.css">
    <link rel="stylesheet" type="text/css" href="/vshow/Public/style/StudentCenter/dropkick.css">
    <link rel="stylesheet" href="/vshow/Public/script/Plug/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Index/reset.css">
    <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Index/comment.css">
    <style type="text/css">
        .form-control{
    .-webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
   box-sizing: border-box; 
}
    </style>
</head>
<body>
    <script type="text/javascript">
	var active = "[active]";
</script>
<div id="header">
		<div class="header-inner">
			<h1 class="logo"><a href="/vshow" title="Vshow唯秀">Vshow唯秀</a></h1>
			<div class="login-box" id="login">
					<?php if(empty($_SESSION['UID'])): ?><a href="/vshow/index.php/Home/User/login" class="login">登陆</a>
					<a href="/vshow/index.php/Home/User/userReg" class="registr">注册</a>
					
				<?php else: ?>
					<?php if($_SESSION['group_id']== 3 ): ?><a href="/vshow/index.php/Home/StudentCenter/index" class="login">个人中心</a>
						<a href="/vshow/index.php/Home/User/logout" class="registr">退出登录</a>
					<?php else: ?>
						<a href="/vshow/index.php/Home/TeacherCenter/index" class="login">个人中心</a>
						<a href="/vshow/index.php/Home/User/logout" class="registr">退出登录</a><?php endif; endif; ?>
				
			</div>
			<div class="search-box" id="search">
				<form action="/vshow/index.php/Home/Index/workList" method="get">
					<input type="text" class="text" name="key" value="输入关键字">
					<input type="submit" class="submit">
				</form>
			</div>	
			<div class="nav" id="nav">
				<div class="nav-inner">
					<li id="index">
						<a href="/vshow/index.php/Home/Index/index.html" title="首页" >
						<strong class="tit">首页</strong><span>index</span>
					</a>
					</li>
					<li id="project">
						<a href="/vshow/index.php/Home/Index/workList.html" title="所有作品">
							<strong class="tit">所有作品</strong><span>project</span>
						</a>
					</li>
					<li id="learning">
						<a href="/vshow/index.php/Home/Index/learning.html" title="学习资源">
							<strong class="tit">学习资源</strong><span>learning</span>
						</a>
					</li>
					<li id="message">
						<a href="/vshow/index.php/Home/Index/message.html" title="留言区">
							<strong class="tit">留言区</strong><span>message</span>
						</a>
					</li>						
				</div>
			</div>				
		</div>
	</div>

    <div class="ucenter">
        <div class="ucenter-top clearfix">
            <!-- <a href="../../../../Vshow/index.php" class="back fl">返回首页</a> -->
        </div>
        <div class="ucenter-wrap clearfix">
            <div class="ucenter-left">
                <div class="ucenter-l-header clearfix">
                    <img src="/vshow/Uploads/Avater/<?php echo (session('avaterPath')); ?>" alt="">
                    <div class="info">
                        <p class="name"><?php echo ($user["truename"]); ?></p>
                        <!-- <p class="grade">网络1班</p> -->
                    </div>
                </div>
                <ul class="ucenter-l-nav" id="ucenterNav">
                    <li><a class="column1" href="javascript:;">修改资料</a></li>
                    <li><a class="column2" href="javascript:;">课程管理</a></li>
                </ul>
            </div>
            <div class="ucenter-right" id="ucenterRight">
                <div class="column-box1 r-content">
                    <!-- <a href="javascript:;" class="btn-green">头像修改</a> -->
                    <!-- <a href="javascript:;" class="select-head"></a> -->
                    <div class="avater-box clearfix">
                        <div class="old-avater fl">
                           <img src="/vshow/Uploads/Avater/<?php echo (session('avaterPath')); ?>" alt="">
                        </div>
                        <form id="avater_form">
                            <img src="" alt="" id="avater_image"  width="322px" height="236px" />
                            <a href="javascript:;" class="btn-green" style="position: absolute;" >选择头像  <input type="file" name="avater" id="avater"  class="validate[required] file-btn" accept=".jpg,.png,.jpeg,.bmp,.gif"/></a>
                        </form>

                        <form id="modify_avater" >
                            <input type="hidden" id="w" name="w">
                            <input type="hidden" id="h" name="h">
                            <input type="hidden" id="x" name="x">
                            <input type="hidden" id="y" name="y">
                            <input type="submit" value="更改头像" class="btn-green" style="display: block;">
                        </form>
                    </div>
                    <div class="clearfix sign">
                        <textarea name="" class="fl textarea" cols="78" rows="7" placeholder="<?php echo ($user["sign"]); ?>" id="edit-sign" value="<?php echo ($user["sign"]); ?>"></textarea>
                        <a href="javascript:;" class="fr btn-green" id="edit-sign-button">修改签名</a>                    
                    </div>

                   <!--  
                        <input type="password" name="pwd" id="password" class="validate[required,minSize[6],maxSize[15],custom[onlyLetterNumber]]"> 
                        <input type="password" name="newpwd" id="new_password" class="validate[required,minSize[6],maxSize[15],custom[onlyLetterNumber]]">
                        <input type="password" name="rqpwd" id="rq_passwd" class="validate[required,equals[new_password]]">
                        <input type="submit" value="更改密码" > -->
                    

                    <form id="modify_pwd">
                        <ul class="ucenter-pw">
                            <li><strong>当前密码：</strong><input type="password" name="pwd" id="password" class="text validate[required,minSize[6],maxSize[15],custom[onlyLetterNumber]]" ></li>
                            <li><strong>新的密码：</strong><input type="password" name="newpwd" class="text validate[required,minSize[6],maxSize[15],custom[onlyLetterNumber]]" id="new_password"></li>
                            <li><strong>确定密码：</strong><input type="password" name="rqpwd" class="text validate[required,equals[new_password]]" id="rq_passwd" ></li>
                            <input type="submit" value="更改密码" class="btn-green" >
                        </ul>
                    </form>
                </div>
    
                <div class="column-box2 r-content">
                 <div class="pub-area">
                        <a href="javascript:;" class="btn btn-success course-button" >添加课程</a>
                </div>
                <div style="margin-top:50px;">
                    <?php if(is_array($courseList)): $i = 0; $__LIST__ = $courseList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$co): $mod = ($i % 2 );++$i;?><div class="list clearfix">
                            <div class="list-wrap clearfix">
                                <div class="img-wrap fl">
                                    <img src="/vshow/Uploads/Course/<?php echo ($co["course_image"]); ?>" alt="" width="120" height="80">
                                </div>
                        <div class="list-cont fl">
                            <h3>&nbsp;&nbsp;&nbsp;<?php echo ($co["course_name"]); ?></h3>
                            <br/>
                            <span style="float:left;">&nbsp;&nbsp;&nbsp;课程简介：</span><span class="course-about"><?php echo ($co["course_about"]); ?></span><br />
                        </div>                              
                        </div>
                        <p class="fr">
                            <a href="/vshow/index.php/Home/Course/t_Index/courseId/<?php echo ($co["id"]); ?>" class="btn-green fl" course-id="<?php echo ($co["id"]); ?>">进入课程</a>
                            <!-- <a href="#" class="btn-green fl">进入学习</a>                -->
                        </p>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>  
                </div>
                  
                </div>
                <div class="column-box4 column-box4-box5 r-content">
                     
                </div>

                <div class="column-box5 column-box4-box5 r-content">
                </div>
            </div>      
        </div>
    </div>
    	<div id="footer">
		<div class="footer-inner clearfix">
			<div class="friend-link fl">
				<h2>友情链接</h2>
				<a href="http://www.gdaib.edu.cn">广东农工商</a>
				<a href="http://2015.dodi.cn/">2015多迪杯</a>
				<a href="http://www.csdn.net/ ">CSDN社区</a>
				<a href="http://www.laruence.com/">风雪之隅</a>
				<a href="http://laravel-china.github.io/php-the-right-way/">PHP之道</a>
				<a href="http://www.zixue.it/">自学IT网</a>
				<a href="http://www.cnblogs.com/">博客园</a>
				<a href="http://code.ciaoca.com/">前端开发仓库</a>
			</div>
			<div class="footer-cont fl">
				<p>关于我们 | 用户服务 | 商务合作 | 联系我们</p>
				<p>Copyright VTeam </p>
				</div>			
		</div>
	</div>
	<script type="text/javascript">
		var root = "/vshow/index.php";
	</script>
	 
     <div class="modal fade courseModal"  tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog" style="width:360px;">
        <div class="modal-content" style="height:320px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="mySmallModalLabel">新增课程</h4>
          </div>
          <div class="modal-body" style="  text-align: center;line-height: 60px;height: 100px;">
             <form id="course_add">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">课程名称：</span>
                  <input type="text" name="course_name" id="course_name" class="validate[required,maxSize[12]] form-control"> 
                </div>

                 <div class="input-group" style="margin-top:20px;">
                  <span class="input-group-addon" id="basic-addon1"> 课程简介：</span>
                  <textarea rows="3" name="course_about" id="course_about" class="validate[required,maxSize[200] form-control"></textarea>
                </div>

                <div class="input-group" style="margin-top:20px;">
                <a href="javascript:;" class="btn btn-success " style="position: absolute;">
                选择图片
                <input type="file" name="course_image" id="course_image" class="file-btn"></a>
                </div>
                <input type="submit" value="新增课程" class="btn btn-success" style="margin-top:50px;">
            </form>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

          <div class="modal fade bs-example-modal-sm" id="message-modal" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="mySmallModalLabel">提示</h4>
          </div>
          <div class="modal-body" style="  text-align: center;line-height: 60px;height: 100px;">
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </div>

    <script type="text/javascript" src="/vshow/Public/script/Index/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Index/jquery-color.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/StudentCenter/jquery.dropkick-min.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Plug/Validation-Engine/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Plug/Validation-Engine/jquery.validationEngine-zh_CN.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Plug/artDialog/dist/dialog-min.js"></script>
    <script src="/vshow/Public/script/Plug/jcrop/js/jquery.Jcrop.js"></script> 
     <script type="text/javascript" src="/vshow/Public/script/Index/easing.1.3.js" ></script>   
    <script type="text/javascript" src="/vshow/Public/script/Index/comm.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Plug/laydate/laydate.dev.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/StudentCenter/ucenter.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/StudentCenter/index.js"></script>
    <script src="/vshow/Public/script/Plug/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
            $(function(){
                    $('.course-button').click(function(){
                        $('.courseModal').modal(true);

                    })
                })
        $('#course_add').validationEngine({
            'custom_error_messages':{
                '#course_name' : {
                    'required':{
                        'message' : '* 请输入课程名称'
                    }
                },
                '#course_about': {
                    'required' : {
                        'message': '* 请输入课程简介'
                    }
                }
            },
            'onValidationComplete' : function(form,status){
                if (status === true) {      
                    var data = new FormData();

                    var course_name = document.getElementById('course_name').value;
                    var course_about = document.getElementById('course_about').value;
                    var __hash__ = document.getElementsByName('__hash__')[1].value;
                    var course_image = $("#course_image")[0].files[0];
                    // console.log(__hash__);return false;
                    data.append('course_name',course_name);
                    data.append('course_about',course_about);
                    data.append('course_image',course_image);
                    data.append('__hash__',__hash__);

                    $.ajax({
                           type:"post",
                           url:"/vshow/index.php/Home/TeacherCenter/CourseAddAction",
                           data: data,
                           processData: false,
                           contentType: false
                       }).done(function(res){
                        $('.courseModal').modal('hide');
                        if (res.status == 0 ) {
                          $('#message-modal .modal-body').text(res.message);
                          $('#message-modal').modal(true);
                        }else{
                          $('#message-modal .modal-body').text(res.message);
                          $('#message-modal').modal(true);
                          setTimeout(function(){
                          $('#message-modal').modal('hide');
                          location.reload(true);
                          },1500)
                       }
                     });
                }
            },
            // 'ajaxFormValidation' : true,
            'ajaxFormValidationMethod' : 'post'
    }); 
    laydate({
            elem: '#homework_expires'
        });
    </script>
</body>
</html>