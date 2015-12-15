<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vshow-秀出自我</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="Vshow学生发布平台,提供学生的作品发布">
    <meta name="keywords" content="Vshow,致力于发展为高校的学生作品发布平台">

    <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Index/reset.css"> 
    <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Index/comment.css">
    <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Index/index.css">

    <script type="text/javascript" src="/vshow/Public/script/Index/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Index/jquery-color.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Index/easing.1.3.js" ></script>   
    <script type="text/javascript" src="/vshow/Public/script/Index/comm.js"></script>

</head>
<body>
    <script type="text/javascript">
	var active = "message";
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
   

 <!--    <div id="header">
        <div class="header-inner">
            <h1 class="logo"><a href="/vshow" title="Vshow唯秀">Vshow唯秀</a></h1>
            <div class="login-box" id="login">
                <a href="/vshow/index.php/Home/User/login" class="login">登陆</a>
                <a href="/vshow/index.php/Home/User/userReg" class="registr">注册</a>
            </div>
            <div class="search-box" id="search">
                <form action="#">
                    <input type="text" class="text" name="text" value="输入关键字">
                    <input type="submit" class="submit" name="submit">
                </form>
            </div>  
            <div class="nav" id="nav">
                <div class="nav-inner">
                    <li><a href="/vshow/index.php/Home/Index/index.html" title="首页" ><strong class="tit">首页</strong><span>index</span></a></li>
                    <li class="active"><a href="/vshow/index.php/Home/Index/workList.html" title="所有作品"><strong class="tit">所有作品</strong><span>project</span></a></li>
                    <li><a href="/vshow/index.php/Home/Index/learning.html" title="学习资源"><strong class="tit">学习资源</strong><span>learning</span></a></li>
                    <li><a href="/vshow/index.php/Home/Index/message.html" title="留言区"><strong class="tit">留言区</strong><span>message</span></a></li>                      
                </div>
            </div>              
        </div>
    </div> -->
    
    <div id="container">
        <div class="main clearfix">
            <div class="message">
                <div class="message-cont">
                    <h2>给我留言</h2>
                    <p>本站接受任何意见或者建议，非常乐于与大家交流。</p>
                    <p>如果对本站的内容有异议或者是本站内容侵犯了您的权益，你可以通过邮件或者直接留言，本站将立即处理。</p>
                    <p>如果有技术性问题或者是想进行学术交流也可以通过以上方式联系本站站长，本站长一定知无不言,言无不尽</p>
                </div>

            <!-- 多说评论框 start -->
                <div class="ds-thread" data-thread-key="1" data-title="2" data-url="http://localhost/vshow/index.php/Home/Index/message.html"></div>
            <!-- 多说评论框 end -->
            <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
            <script type="text/javascript">
            var duoshuoQuery = {short_name:"monsoon4948"};
                (function() {
                    var ds = document.createElement('script');
                    ds.type = 'text/javascript';ds.async = true;
                    ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                    ds.charset = 'UTF-8';
                    (document.getElementsByTagName('head')[0] 
                     || document.getElementsByTagName('body')[0]).appendChild(ds);
                })();
                </script>
            <!-- 多说公共JS代码 end -->
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
	 
</body>
</html>