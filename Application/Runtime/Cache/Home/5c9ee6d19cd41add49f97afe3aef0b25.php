<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Vshow-用户登录</title>
	<link rel="stylesheet" type="text/css" href="/vshow/Public/style/Index/reset.css">	
	<link rel="stylesheet" type="text/css" href="/vshow/Public/style/Common/buttons.css">	
	<link rel="stylesheet" type="text/css" href="/vshow/Public/style/Index/comment.css">
	<link rel="stylesheet" type="text/css" href="/vshow/Public/style/User/login.css">
	<link rel="stylesheet" type="text/css" href="/vshow/Public/style/Plug/Validation-Engine/validationEngine.jquery.css">
	<link rel="stylesheet" type="text/css" href="/vshow/Public/script/Plug/artDialog/css/ui-dialog.css">
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
	
	<div id="container">
		<div class="main">
			<div class="left">
				<img src="/vshow/Public/images/User/black.jpg" alt=""  width="" />
			</div>
			<div class="right">
				<div class="login-box2">
					<form id="login-form">
					<ul>
						<li class="login-title">用户登录</li>
						<li id="msg"></li>
						<li>
							<div class="login-input-box">
								<img src="/vshow/Public/images/User/user.png" alt="" height="34px;" />
								<input type="text" name="uname" id="uname" class="login-input-style validate[required,minSize[4],maxSize[15]]">
							</div>
						</li>
						<li style="margin-top:30px">
							<div class="login-input-box">
								<img src="/vshow/Public/images/User/pass.png" alt="" height="34px;" />
								<input type="password" name="pwd" id="pwd" class="login-input-style" class="login-input-style validate[required,minSize[6],maxSize[15]]">
							</div>
						</li>
						<li style="margin-top:30px;">
							<span class="auth"><input type="checkbox" name="auth" />自动登录</span>
							<span class="forget"><a href="javascript:;" id="forgetPass">忘记密码?</a></span>
						</li>
						<li>
							<input type="submit" class="login-btn" value="">
						</li>
						<li class="login-qq">
							<span >使用第三方账号登录：</span><img src="/vshow/Public/images/User/login-qq.png" alt="" />
						</li>
						<li class="userReg">
							<span>还不是会员？<a href="/vshow/index.php/Home/User/userReg">立即注册</a></span>
						</li>
					</ul>
					</form>
				</div>
			</div>
			<!--  -->
		</div>
	</div>

	<div id="forgetDiv" style="display:none">
		<form id="forgetForm" style="margin-top:10px;">
			<div class="error-msg" style="margin-bottom:10px;color:red;margin-left:120px;">	</div><br/>
			用户名：<input type="text" name="username" class="input-style validate[required]" style="width:300px;border-radius:0px;" />
			<br/>
			<br/>

			<br/>

			邮 &nbsp;&nbsp;箱：&nbsp;<input type="text" name="email" class="input-style validate[required,custom[email]]" style="width:300px;border-radius:0px;"/>
			<br/>
			<input type="submit" value="找回密码" class="button button-glow button-rounded button-raised button-primary" style="margin-top:30px;margin-left:120px;">
		</form>
	</div>
	</div>
	<!-- <script type="text/javascript">
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
	</div> -->

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
	 

	<!-- <a href="#"><img src="/vshow/Public/images/Common/Connect_logo_3.png" alt="" /></a> -->
<script type="text/javascript" src="/vshow/Public/script/Common/jquery-1.10.2.js"></script>
<script type="text/javascript" src="/vshow/Public/script/Plug/Validation-Engine/jquery.validationEngine.js"></script>
<script type="text/javascript" src="/vshow/Public/script/Plug/Validation-Engine/jquery.validationEngine-zh_CN.js"></script>
<script type="text/javascript" src="/vshow/Public/script/Plug/artDialog/dist/dialog-min.js"></script>
<script type="text/javascript" src="/vshow/Public/script/Index/jquery-color.js"></script>
<script type="text/javascript" src="/vshow/Public/script/Index/easing.1.3.js" ></script>	
<script type="text/javascript" src="/vshow/Public/script/Index/comm.js"></script>
<script type="text/javascript" src="/vshow/Public/script/User/login.js"></script>
</body>
</html>