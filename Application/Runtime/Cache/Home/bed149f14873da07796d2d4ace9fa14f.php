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
    <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Plug/Validation-Engine/validationEngine.jquery.css">
    <link rel="stylesheet" type="text/css" href="/vshow/Public/script/Plug/artDialog/css/ui-dialog.css">
    <script type="text/javascript" src="/vshow/Public/script/Index/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/StudentCenter/jquery.dropkick-min.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Plug/Validation-Engine/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Plug/Validation-Engine/jquery.validationEngine-zh_CN.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Plug/artDialog/dist/dialog-min.js"></script>
     <script type="text/javascript" src="/vshow/Public/script/Index/easing.1.3.js" ></script>   
    <script type="text/javascript" src="/vshow/Public/script/Index/comm.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Index/jquery-color.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Works/showWorks.js"></script>
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
            <div class="works-info clearfix">
                <div class="works-left fl">
                    <div class="tit clearfix">
                        <h2 class="fl"><?php echo ($worksInfo["works_name"]); ?></h2>
                        <a href="/vshow/index.php/Home/Works/showWork/id/<?php echo ($worksInfo["id"]); ?>" class="btn-blue fr">查看作品</a>                        
                    </div>
                    <div class="img-wrap">
                        <a href="#"><img src="/vshow/Uploads/Works/b_<?php echo ($worksInfo["works_image"]); ?>"></a>
                    </div>
                    <div class="info clearfix">
                        <span>作品简介:</span>
                        <p><?php echo ($worksInfo["works_about"]); ?></p>
                    </div>
                    <div class="teach clearfix">
                        <span>教师点评:</span>
                        <p><?php echo ($worksInfo["comment"]); ?></p>
                    </div>
                </div>
                <div class="works-right fr">
                    <div class="uinfo clearfix">
                        <div class="img-wrap fl">
                            <img src="/vshow/Uploads/Avater/<?php echo ($userInfo["avater_path"]); ?>">
                        </div>
                        <div class="uinfo-cont fl">
                            <span><?php echo ($userInfo["truename"]); ?></span>
                            <p><?php echo ($userInfo["sign"]); ?></p>
                        </div>
                    </div>

                    <div class="proinfo">
                        <div class="tit">作品信息</div>
                        <ul class="proinfo-cont">
                            <li><span>作品名称:</span><em><?php echo ($worksInfo["works_name"]); ?></em></li>
                            <li><span>作者姓名:</span><em><?php echo ($userInfo["truename"]); ?></em></li>
                            <li><span>教师评分:</span><em><?php echo ($worksInfo["score"]); ?></em></li>
                            <li><span>发布时间:</span><em><?php echo (date("Y-m-d",$worksInfo["works_pubtime"])); ?></em></li>
                            <li><span>点击数:</span><em><?php echo ($countsInfo["click_counts"]); ?></em></li>
                            <li><span>作品下载:</span><em class="btn-green"><a href="#">点击下载</a></em></li>              
                        </ul>
                    </div>

                    <ul class="other clearfix">
                        <li>
                            <a href="javascript:;" class="operation" oid="1">
                                <span>赞</span>
                                <em><?php echo ($countsInfo["praise_counts"]); ?></em>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" class="operation" oid="2">
                                <span>收藏</span>
                                <em><?php echo ($countsInfo["collect_counts"]); ?></em>
                            </a>                            
                        </li>
                        <li style="margin-right: 0;">
                            <a href="javascript:;">
                                <span>评论</span>
                                <em><?php echo ($countsInfo["comment_counts"]); ?></em>
                            </a>                            
                        </li>
                    </ul>
                    <div class="link">
                        <div class="bdsharebuttonbox" id="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div> <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
                    </div>
                </div>
            <!-- 多说评论框 start -->
    <div class="ds-thread works-left" data-thread-key="<?php echo ($worksInfo["id"]); ?>" data-title="" data-url="/vshow/index.php/Home/Works/s/id/17" style="float: left;
margin-top: 20px;"></div>
<!-- 多说评论框 end -->
<!-- 多说公共JS代码 start (一个网页只需插入一次) -->
<script type="text/javascript">
var duoshuoQuery = {short_name:"nvshow"};
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
	 
    <script type="text/javascript">
    $(function(){
      $('.operation').click(function(){
          var $aObj = $(this); 
          var wid   = "<?php echo ($worksInfo["id"]); ?>";
          var oid   = $(this).attr('oid');

          $.post('/vshow/index.php/Home/Works/doCounts',{wid : wid, oid : oid},
                function(data,status){
                    // console.log(data);
                    if (data.status == '0') {
                        D('你还没登陆哦<img src="/vshow/Public/images/Common/doge_thumb.gif">').showModal();
                    }else{
                        $aObj.find('em').html(data.message);
                        // console.log($(this));
                    }
             });
        });

        function D(content,direction){
            var d = dialog({
                align : direction,
                content : content,
            })

            setTimeout(function () {
                d.close();
            }, 1900);

            return d;
         }
    })
    </script>
</body>