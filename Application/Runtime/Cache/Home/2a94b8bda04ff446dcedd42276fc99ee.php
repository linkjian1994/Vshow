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
<body><script>
	//nav-scroll
	$(function() {
		(function() {
			var onOff = false;

			var on = true;
			$(window).scroll(function() {
				if($(window).scrollTop()>=750){
					if(on) {
						$("#nav").css({
							"height": 0,
							"opacity": 0
						}).addClass("fixedNav");

						on = !on;						
					}

					$("#nav").stop().animate({
						"height": 44,
						"opacity": 1
					})

					onOff = true;
				}else {
					if(onOff) {
						$("#nav").stop().animate({
							"height": 0,
							"opacity": 0
						}, function() {
							$(this).removeClass("fixedNav").css({
								"height": 44,
								"opacity": 1
							});
						})	
						onOff = false;
						on = !on;											
					}

				} 
			});

		})();
	})
</script>
	<script type="text/javascript">
	var active = "index";
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
			<div class="top-warp clearfix">
				<div class="slider-left fl" id="slider">
					<span class="prev"></span>
					<span class="next"></span>				
					<div class="slider-big">
						<div class="slider-big-inner">
						<?php if(is_array($recWorkList)): $i = 0; $__LIST__ = $recWorkList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="/vshow/index.php/Home/Works/s/id/<?php echo ($vo["id"]); ?>" title="<?php echo ($vo["works_name"]); ?>"><img src="/vshow/Uploads/Works/b_<?php echo ($vo["works_image"]); ?>" alt="<?php echo ($vo["works_name"]); ?>"></a><?php endforeach; endif; else: echo "" ;endif; ?>					
						</div>
					</div>
					<div class="slider-sm">
						<?php if(is_array($recWorkList)): $i = 0; $__LIST__ = $recWorkList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="#" title="<?php echo ($vo["works_name"]); ?>"><img src="/vshow/Uploads/Works/<?php echo ($vo["works_image"]); ?>" alt="<?php echo ($vo["works_name"]); ?>"></a><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
			
				<div class="slider-right fr" id="slider-right">
					<ul class="most-tit clearfix">
						<li class="tit1"><a href="javascript:;">最高点击<i></i></a></li>
						<li class="tit2"><a href="javascript:;" >最新作品<i></i></a></li>
					</ul>
					<ul class="most-cont" >
						<li class="most-main">
						<?php if(is_array($maxWorkList)): $i = 0; $__LIST__ = $maxWorkList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl class="mostCont">
								<dd>
									<em <?php if($i < 4): ?>style="border: 1px solid rgb(221, 34, 34); color: rgb(221, 34, 34);"<?php endif; ?>>0<?php echo ($i); ?></em>
									<strong><a href="/vshow/index.php/Home/Works/s/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["works_name"]); ?></a></strong>
									<span><a href="#"><?php echo ($vo["works_author"]); ?></a></span>
								</dd>						
							</dl><?php endforeach; endif; else: echo "" ;endif; ?>
						</li>
						<li class="most-main">
							<?php if(is_array($newWorkList)): $i = 0; $__LIST__ = $newWorkList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl class="mostCont">	
									<dd>
										<em <?php if($i < 4): ?>style="border: 1px solid rgb(221, 34, 34); color: rgb(221, 34, 34);"<?php endif; ?>>0<?php echo ($i); ?></em>
										<strong><a href="/vshow/index.php/Home/Works/s/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["works_name"]); ?></a></strong>
										<span><a href="#"><?php echo ($vo["works_author"]); ?></a></span>
									</dd>						
							</dl><?php endforeach; endif; else: echo "" ;endif; ?>	
						</li>
					</ul> 	
					<div class="tag-cloud">
						<h3>标签云</h3>
						<div class="cloud-main">
							<a href="#" class="tag"><i class="triangle_left"></i>html5</a>
							<a href="#" class="tag"><i class="triangle_left"></i>css3</a>
							<a href="#" class="tag"><i class="triangle_left"></i>js</a>
							<a href="#" class="tag"><i class="triangle_left"></i>php</a>
							<a href="#" class="tag" style="margin-right: 0;"><i class="triangle_left"></i>企业</a>
							<a href="#" class="tag"><i class="triangle_left"></i>精美</a>
							<a href="#" class="tag"><i class="triangle_left"></i>简洁</a>
							<a href="#" class="tag"><i class="triangle_left"></i>精美</a>
							<a href="#" class="tag"><i class="triangle_left"></i>黑色</a>
							<a href="#" class="tag" style="margin-right: 0;"><i class="triangle_left"></i>学校</a>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="hot-recomm clearfix">
				<h2>热门推荐</h2>
				<ul class="works-box clearfix" id="worksBox">
					<?php if(is_array($hotWorkList)): $i = 0; $__LIST__ = $hotWorkList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="hotWorkList<?php echo ($i); ?>">
							<div class="img-box">
								<a href="/vshow/index.php/Home/Works/s/id/<?php echo ($vo["id"]); ?>" title="<?php echo ($vo["works"]["name"]); ?>" class="zoom">
									<img src="/vshow/Uploads/Works/m_<?php echo ($vo["works_image"]); ?>" alt="">
								</a>							
							</div>
							<div class="img-cont">
								<h4><a href="#" title="<?php echo ($vo["works_name"]); ?>"><?php echo ($vo["works_name"]); ?></a></h4>
								<div class="head fl"><a href="#" title=""><img src="/vshow/Uploads/Avater/<?php echo ($vo["avater_path"]); ?>" alt="<?php echo ($vo["works_author"]); ?>"></a></div>
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
			</div> -->
			<div class="works-display clearfix">
				<h2>作品展示</h2>
				<ul class="works-box" id="worksBox">
					<?php if(is_array($showWorkList)): $i = 0; $__LIST__ = $showWorkList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="showWorkList<?php echo ($i); ?>">
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
			</div>
			<div class="bottom-warp clearfix" id="bottomWarp">
				<div class="learning fl">
					 <h2>学习资源<a href="#" title="更多">更多&gt;&gt;</a></h2>
					 <ul class="clearfix" id="learning">
					 	<li>
						 	<a href="#" title="">
						 		<img src="/vshow/Public/images/Index/pic_html5.jpg" alt="">
						 		<div class="zoomOverlay2">
						 			<h4>10天学会HTML5+CSS3</h4>
						 			<p>语义元素清晰地向浏览器和开发人员表明了它们的涵义和用途，要..</p>
						 		</div>
						 	</a>
					 	</li>
					 	<li style="margin-right: 0;">
						 	<a href="#" title="">
						 		<img src="/vshow/Public/images/Index/pic_js.jpg" alt="">
						 		<div class="zoomOverlay2">
						 			<h4>10天学会Javascript</h4>
						 			<p>演进和使用的JavaScript是早在1995年开发的一种语言,真..</p>
						 		</div>
						 	</a>
					 	</li>
					 	<li>
						 	<a href="#" title="">
						 		<img src="/vshow/Public/images/Index/pic_jquery.jpg" alt="">
						 		<div class="zoomOverlay2">
						 			<h4>10天学会Jquery</h4>
						 			<p>10天学会jquery,深入语义，让同学们更好的理解整个页面，希..</p>
						 		</div>
						 	</a>
					 	</li>
					 	<li style="margin-right: 0;">
						 	<a href="#" title="">
						 		<img src="/vshow/Public/images/Index/pic_php.jpg" alt="">
						 		<div class="zoomOverlay2">
						 			<h4>10天学会php+mysql</h4>
						 			<p>10天学会php，让同学们更好的理解整个页面,深入语义，希望大..</p>
						 		</div>
						 	</a>
					 	</li>
					 </ul>
				</div>	
				<div class="student-recomm fl" id="studentRecomm">
					<h2>学生推荐<a href="#">更多&gt;&gt;</a></h2>
					<ul>
						<li>
							<div class="head"><a href="#"><img src="/vshow/Public/images/Index/img1.jpg" alt=""></a></div>
							<strong><a href="#" title="是时时刻刻是">陈国龙</a></strong>
							<p><a href="#" title="计算机网络专业">计算机网络专业</a></p>
							<span>粉丝：</span><em>13</em>
							<span>作品：</span><em>0</em>
						</li>
						<li>
							<div class="head"><a href="#"><img src="/vshow/Public/images/Index/img3.jpg" alt=""></a></div>
							<strong><a href="#" title="是时时刻刻是">林健</a></strong>
							<p><a href="#" title="计算机网络专业">计算机网络专业</a></p>
							<span>粉丝：</span><em>23</em>
							<span>作品：</span><em>5</em>
						</li>
						<li>
							<div class="head"><a href="#"><img src="/vshow/Public/images/Index/img6.jpg" alt=""></a></div>
							<strong><a href="#" title="是时时刻刻是">付零秀</a></strong>
							<p><a href="#" title="计算机网络专业">计算机网络专业</a></p>
							<span>粉丝：</span><em>5</em>
							<span>作品：</span><em>4</em>
						</li>
						<li>
							<div class="head"><a href="#"><img src="/vshow/Public/images/Index/img7.jpg" alt=""></a></div>
							<strong><a href="#" title="是时时刻刻是">邓志涛</a></strong>
							<p><a href="#" title="计算机网络专业">计算机网络专业</a></p>
							<span>粉丝：</span><em>2</em>
							<span>作品：</span><em>0</em>
						</li>
						<li>
							<div class="head"><a href="#"><img src="/vshow/Public/images/Index/img5.jpg" alt=""></a></div>
							<strong><a href="#" title="是时时刻刻是">钟翠华</a></strong>
							<p><a href="#" title="计算机网络专业">计算机多媒体专业</a></p>
							<span>粉丝：</span><em>10</em>
							<span>作品：</span><em>2</em>
						</li>
					</ul>
				</div>
				<div class="tech-article fl" id="techArticle">
					<h2>技术文章<a href="#">更多&gt;&gt;</a></h2>
					<ul class="clearfix">
						<li>
							<b>01</b>
							<strong><a href="#">js性能优化，收藏!</a></strong>
							<a href="#"><img src="/vshow/Public/images/Index/img1.jpg" alt=""></a>
							<em><a href="#">陈国龙</a></em>
							<span class="time">2015-05-22</span>
						</li>
						<li>
							<b>02</b>
							<strong><a href="#">移动端开发界面</a></strong>
							<a href="#"><img src="/vshow/Public/images/Index/img2.jpg" alt=""></a>
							<em><a href="#">林健</a></em>
							<span class="time">2015-05-21</span>
						</li>
						<li>
							<b>03</b>
							<strong><a href="#">类似百度页面</a></strong>
							<a href="#"><img src="/vshow/Public/images/Index/img7.jpg" alt=""></a>
							<em><a href="#">邓子涛</a></em>
							<span class="time">2015-05-20</span>
						</li>
						<li>
							<b>04</b>
							<strong><a href="#">移动端浏览器30坑</a></strong>
							<a href="#"><img src="/vshow/Public/images/Index/img6.jpg" alt=""></a>
							<em><a href="#">付零检</a></em>
							<span class="time">2015-05-20</span>
						</li>
						<li>
							<b>05</b>
							<strong><a href="#">前端常用技术汇总</a></strong>
							<a href="#"><img src="/vshow/Public/images/Index/img5.jpg" alt=""></a>
							<em><a href="#">零件</a></em>
							<span class="time">2015-04-22</span>
						</li>
						<li>
							<b>06</b>
							<strong><a href="#">六款jQuery插件</a></strong>
							<a href="#"><img src="/vshow/Public/images/Index/img4.jpg" alt=""></a>
							<em><a href="#">邓小华</a></em>
							<span class="time">2015-04-22</span>
						</li>
						<li>
							<b>07</b>
							<strong><a href="#">加载进度条交互设计</a></strong>
							<a href="#"><img src="/vshow/Public/images/Index/img3.jpg" alt=""></a>
							<em><a href="#">名华</a></em>
							<span class="time">2015-02-21</span>
						</li>
						<li>
							<b>08</b>
							<strong><a href="#">快切助手</a></strong>
							<a href="#"><img src="/vshow/Public/images/Index/img2.jpg" alt=""></a>
							<em><a href="#">晨斌</a></em>
							<span class="time">2015-04-12</span>
						</li>
						<li>
							<b>09</b>
							<strong><a href="#">jq简单仿写2cars游戏</a></strong>
							<a href="#"><img src="/vshow/Public/images/Index/img1.jpg" alt=""></a>
							<em><a href="#">黄小明</a></em>
							<span class="time">2015-03-22</span>
						</li>
						<li>
							<b>10</b>
							<strong><a href="#">单页开发必备插件</a></strong>
							<a href="#"><img src="/vshow/Public/images/Index/img1.jpg" alt=""></a>
							<em><a href="#">黄分衫</a></em>
							<span class="time">2015-02-21</span>
						</li>
						<li>
							<b>11</b>
							<strong><a href="#">Canvas头发飘逸动画</a></strong>
							<a href="#"><img src="/vshow/Public/images/Index/img1.jpg" alt=""></a>
							<em><a href="#">东晓</a></em>
							<span class="time">2015-05-21</span>
						</li>
					</ul>
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
	 
</body>
</html>