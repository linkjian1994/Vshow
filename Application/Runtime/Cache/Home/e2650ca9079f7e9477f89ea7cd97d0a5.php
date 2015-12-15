<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>课程公告</title>
  <link rel="stylesheet" href="/vshow/Public/script/Plug/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Course/common.css">

<!-- 可选的Bootstrap主题文件（一般不用引入） -->
<link rel="stylesheet" href="/vshow/Public/script/Plug/bootstrap/css/bootstrap-theme.min.css">
 <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Plug/Validation-Engine/validationEngine.jquery.css">
  <script type="text/javascript">var root = "/vshow/index.php";</script>
<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="/vshow/Public/script/Common/jquery-1.10.2.js"></script>
 
<script type="text/javascript" src="/vshow/Public/script/Plug/Validation-Engine/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Plug/Validation-Engine/jquery.validationEngine-zh_CN.js"></script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="/vshow/Public/script/Plug/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/vshow/Public/script/Plug/artDialog/dist/sea.js"></script>

<script type="text/javascript" src="/vshow/Public/script/Plug/artDialog/dist/dialog-min.js"></script>
</head>
<body>

  <div id="header">
	<div class="header-inner">
		<h1 class="logo"><a href="/vshow/index.php/Home/Course/t_Index/courseId/<?php echo ($_GET['courseId']); ?>" title="Vshow唯秀"><?php echo ($courseName); ?></a></h1>
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
		
	</div>
</div>	
	<ul class="nav nav-tabs nav-justified">
	   <li role="presentation" id="notice-li"><a href="/vshow/index.php/Home/Course/t_Index/courseId/<?php echo ($_GET['courseId']); ?>">课程公告</a></li>
	  <li role="presentation" id="resource-li"><a href="/vshow/index.php/Home/Course/t_ShowResource/courseId/<?php echo ($_GET['courseId']); ?>">课程资源</a></li>
	  <li role="presentation" id="interflow-li"><a href="/vshow/index.php/Home/Course/t_ShowInterflow/courseId/<?php echo ($_GET['courseId']); ?>">互动交流</a></li>
	  <li role="presentation" id="homeowork-li"><a href="/vshow/index.php/Home/Course/t_ShowHomework/courseId/<?php echo ($_GET['courseId']); ?>">课程作业</a></li>
	</ul>
	<script type="text/javascript">
		$(function(){
			var active = "notice-li";
			console.log($("#"+active));
			$('.nav-tabs li').attr('class','');
			$("#"+active).addClass('active');
			
		})

	</script>	
    
    <div class="main">
    
    <div class="pub-area">
      <a href="javascript:;" class="btn btn-success" id="pub-notice-btn">发布公告</a>
    </div>

     <table class="tableList table table-striped table-bordered table-hover">
        <tr>
          <th>标题</th>
          <th>发布时间</th>
          <th>发布人</th>
        </tr>
        <?php if(is_array($noticeList)): $i = 0; $__LIST__ = $noticeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$no): $mod = ($i % 2 );++$i;?><tr>
                <td><a href="/vshow/index.php/Home/Course/s_ShowNoticeInfo/courseId/<?php echo ($_GET['courseId']); ?>/noticeId/<?php echo ($no["id"]); ?>"><?php echo ($no["title"]); ?></a></td>
                <td><?php echo (date("Y-m-d",$no["pub_time"])); ?></td>
                <td><?php echo ($no["teacher_name"]); ?></td>
            </tr>
            <tr>
              <?php echo ($page); ?>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>   
    </div>
    <div class="modal fade " id="notice-modal" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog" style="width:350px;">
        <div class="modal-content" style="height:300px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="mySmallModalLabel">发布公告</h4>
          </div>
          <div class="modal-body" style="  text-align: center;line-height: 60px;height: 100px;">
            <form id="notice-form">
          
              <div class="input-group">
              <input type="text" class="form-control validate[required]" placeholder="标题" aria-describedby="basic-addon1" style="width:300px;" name="title" id="notice-title">
              </div>
              <p></p>
              <div class="input-group">
                <input type="text" class="form-control validate[required]" placeholder="内容" aria-describedby="basic-addon1" style="height:90px;width:300px;" name="content" id="notice-content">
              </div>
              <p>
              <input class="btn btn-success" id="notice-button" type="submit" value="提交" courseId="<?php echo ($_GET['courseId']); ?>">
          </p>
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
  <script type="text/javascript">
  $(function(){
      $('#pub-notice-btn').click(function(){
        $('#notice-modal').modal(true);
      });
    


   $('#notice-form').validationEngine({
    'custom_error_messages':{
      '#notice-title' : {
        'required':{
          'message' : '* 请输入公告标题'
        }
      },
      '#notice-content': {
        'required' : {
          'message': '* 请输入公告内容'
        }
      }
    },
    'onValidationComplete' : function(form,status){
      if (status === true) {
          var title    = $('#notice-title').val();
          var content  = $('#notice-content').val();
          var course_id = $('#notice-button').attr('courseId'); 
          var __hash__ = $('input[name=__hash__]').val();

          $.post('/vshow/index.php/Home/Course/t_PubNotice',
            {
              title     :  title,
              content   :  content,
              course_id  :  course_id,
              __hash__      :  __hash__
            },function(data,status){
               $('#notice-modal').modal('hide');
               if (data.status == 0 ) {
                  $('#message-modal .modal-body').text(data.message);
                  $('#message-modal').modal(true);
                }else{
                   $('#message-modal .modal-body').text(data.message);
                   $('#message-modal').modal(true);
                     setTimeout(function(){
                  $('#message-modal').modal('hide');
                  location.reload(true);
                },1500)
               }
          })  
        }
    },
    // 'ajaxFormValidation' : true,
    'ajaxFormValidationMethod' : 'post'
  })
  })
  </script>
    <!-- 	<div id="footer">
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
	  -->

</body>
</html>