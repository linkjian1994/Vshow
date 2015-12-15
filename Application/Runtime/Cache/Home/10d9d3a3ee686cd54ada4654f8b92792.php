<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vshow-秀出自我</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="Vshow学生发布平台,提供学生的作品发布">
    <meta name="keywords" content="Vshow,致力于发展为高校的学生作品发布平台">
    <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Index/reset.css"> 
    <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Plug/Validation-Engine/validationEngine.jquery.css">
    <link rel="stylesheet" type="text/css" href="/vshow/Public/script/Plug/artDialog/css/ui-dialog.css">
    <link rel="stylesheet" href="/vshow/Public/script/Plug/jcrop/css/jquery.Jcrop.css">
    <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Index/comment.css">
    <link rel="stylesheet" type="text/css" href="/vshow/Public/style/StudentCenter/ucenter.css">
    <link rel="stylesheet" type="text/css" href="/vshow/Public/style/StudentCenter/dropkick.css">
    

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
                        <p class="name"><?php echo (session('truename')); ?></p>
                        <!-- <p class="grade">网络1班</p> -->
                    </div>
                </div>
                <ul class="ucenter-l-nav" id="ucenterNav">
                    <li><a class="column1" href="/vshow/index.php/Home/StudentCenter/index">修改资料</a></li>
                    <li><a class="column2" href="/vshow/index.php/Home/StudentCenter/upload">作品上传</a></li>
                    <li><a class="column3" href="/vshow/index.php/Home/StudentCenter/course">课程管理</a></li>
                    <li><a class="column4" href="/vshow/index.php/Home/StudentCenter/homework">作品管理</a></li>
                    <li><a class="column5" href="/vshow/index.php/Home/StudentCenter/collect">我的收藏</a></li>
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
                        <textarea name="" class="fl textarea" cols="78" rows="7" placeholder="<?php echo ($user["sign"]); ?>" id="edit-sign" value="<?php echo (session('sign')); ?>"></textarea>
                        <a href="javascript:;" class="fr btn-green" id="edit-sign-button">修改签名</a>                    
                    </div>


                    <form id="modify_pwd">
                        <ul class="ucenter-pw">
                            <li><strong>当前密码：</strong><input type="password" name="pwd" id="password" class="text validate[required,minSize[6],maxSize[15],custom[onlyLetterNumber]]" ></li>
                            <li><strong>新的密码：</strong><input type="password" name="newpwd" class="text validate[required,minSize[6],maxSize[15],custom[onlyLetterNumber]]" id="new_password"></li>
                            <li><strong>确定密码：</strong><input type="password" name="rqpwd" class="text validate[required,equals[new_password]]" id="rq_passwd" ></li>
                            <input type="submit" value="更改密码" class="btn-green" >
                        </ul>
                    </form>
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
	 
<script type="text/javascript" src="/vshow/Public/script/Index/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Index/jquery-color.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/StudentCenter/jquery.dropkick-min.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Plug/Validation-Engine/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Plug/Validation-Engine/jquery.validationEngine-zh_CN.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Plug/artDialog/dist/dialog-min.js"></script>
    <script src="/vshow/Public/script/Plug/jcrop/js/jquery.Jcrop.js"></script> 
     <script type="text/javascript" src="/vshow/Public/script/Index/easing.1.3.js" ></script>   
    <script type="text/javascript" src="/vshow/Public/script/Index/comm.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/StudentCenter/ucenter.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/StudentCenter/index.js"></script>
</body>
</html>