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
    <script type="text/javascript">
        var ROOT = "/vshow";
        var APP =  "/vshow/index.php";
    </script>   
    <script type="text/javascript" src="/vshow/Public/script/Index/comm.js"></script>

</head>
<body>
    <script type="text/javascript">
	var active = "project";
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
            <div class="assort" id="assort">
                <ul>
                    <li class="type-sort">
                        <strong>分类</strong>
                        <dl>
                            <dd><a href="#" id="type-all" class="active">全部作品</a></dd>
                            <dd><a href="#" id="type-web">网页作品</a></dd>
                        </dl>
                    </li>
                    <li class="hot-sort">
                        <strong>排序</strong>
                        <dl>
                            <dd><a href="#" id="sort-new" class="active">最新</a></dd>
                            <dd><a href="#" id="sort-hot">最热</a></dd>
                            <dd><a href="#" id="sort-col">收藏</a></dd>
                            <dd><a href="#" id="sort-prc">点赞</a></dd>
                        </dl>
                    </li>
                   <!--  <li class="class-sort">
                        <strong>班级</strong>
                        <dl>
                            <dd><a href="#">13网络1班</a></dd>
                            <dd><a href="#">13网络2班</a></dd>
                            <dd><a href="#">14网络1班</a></dd>
                            <dd><a href="#">14网络2班</a></dd>
                            <dd><a href="#">14网络3班</a></dd>
                        </dl>
                    </li> -->
                    <!-- <li class="label-sort">
                        <strong>标签</strong>
                        <dl>
                            <dd><a href="#">HTML5</a></dd>
                            <dd><a href="#">CSS3</a></dd>
                            <dd><a href="#">Javascript</a></dd>
                            <dd><a href="#">php</a></dd>
                            <dd><a href="#">jquery</a></dd>
                            <dd><a href="#">bootstrap</a></dd>
                        </dl>
                    </li> -->
                </ul>
            </div>
            <ul class="works-box clearfix" id="worksBox">
            <!--     <li>
                    <div class="img-box">
                        <a href="#" title="设计师规划" class="zoom">
                            <img src="/vshow/Public/images/Index/img1.jpg" alt="">
                        </a>                            
                    </div>
                    <div class="img-cont">
                        <h4><a href="#" title="作品名称等等">作品名称等等</a></h4>
                        <div class="head fl"><a href="#" title="作者名称"><img src="/vshow/Public/images/Index/img1.jpg" alt="作者名称"></a></div>
                        <div class="author fl"><a href="#">作者名字</a></div>
                        <div class="time fr">2015-04-22</div>
                        <div class="other">
                            <dl class="clearfix">
                                <dd class="view">100</dd>
                                <dd class="love">20</dd>
                                <dd class="star">10</dd>
                                <dd class="weixin">300</dd>
                            </dl>                               
                        </div>
                    </div>
                </li> -->
                <?php if(empty($allWorkList)): ?><div class="empty-message">
                        很抱歉，未能查找到内容
                    </div><?php endif; ?>
                <?php if(is_array($allWorkList)): $i = 0; $__LIST__ = $allWorkList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li id="allwWorkList<?php echo ($i); ?>">
                        <div class="img-box">
                            <a  href="/vshow/index.php/Home/Works/s/id/<?php echo ($vo["id"]); ?>" title="<?php echo ($vo["works"]["name"]); ?>" class="zoom">
                                <img src="/vshow/Uploads/Works/m_<?php echo ($vo["works_image"]); ?>" alt="">
                            </a>                            
                        </div>
                        <div class="img-cont">
                            <h4><a href="#" title="<?php echo ($vo["works_name"]); ?>"><?php echo ($vo["works_name"]); ?></a></h4>
                        
                            <div class="head fl"><a href="#" title="<?php echo ($vo["works_author"]); ?>"><img src="/vshow/Uploads/Avater/<?php echo ($vo["avater_path"]); ?>" alt="<?php echo ($vo["works_author"]); ?>"></a></div>
                            <div class="author fl"><a href="#"><?php echo ($vo["works_author"]); ?></a></div>
                            <div class="time fr"><?php echo (date("Y-m-d",$vo["works_pubtime"])); ?></div>
                            <div class="other">
                                <dl class="clearfix">
                                    <dd class="view"><?php echo ($vo["click_counts"]); ?></dd>
                                        <dd class="love"><?php echo ($vo["praise_counts"]); ?></dd>
                                        <dd class="star">0</dd>
                                        <dd class="weixin"><?php echo ($vo["comment_counts"]); ?></dd>
                                </dl>                               
                            </div>
                        </div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
               
            </ul>
            <div class="page" id="page">
               <?php echo ($page); ?>
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