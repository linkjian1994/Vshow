<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title><?php echo ($user["truename"]); ?>个人中心</title>
   <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Course/common.css">

    <link rel="stylesheet" href="/vshow/Public/script/Plug/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Plug/Validation-Engine/validationEngine.jquery.css">
    <link rel="stylesheet" href="/vshow/Public/script/Plug/bootstrap/css/bootstrap-theme.min.css">
    <script type="text/javascript">var root = "/vshow/index.php";</script>
    <script src="/vshow/Public/script/Common/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Plug/Validation-Engine/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Plug/Validation-Engine/jquery.validationEngine-zh_CN.js"></script>
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
			var active = "interflow-li";
			console.log($("#"+active));
			$('.nav-tabs li').attr('class','');
			$("#"+active).addClass('active');
			
		})

	</script>	
   <div class="main">
    
    <div class="pub-area">
      <a href="javascript:;" class="btn btn-success" id="pub-notice-btn" style="float:right">我要提问</a>
    </div>

  <table class="tableList table table-striped table-bordered table-hover">
    <tr>
      <th>问题</th>
      <th>提问人</td>
      <th>提问时间</td>
      <th>操作</td>
    </tr>
    <?php if(is_array($interFlowList)): $i = 0; $__LIST__ = $interFlowList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td><a href="/vshow/index.php/Home/Course/s_ShowInterFlowInfo/courseId/<?php echo ($vo["course_id"]); ?>/interId/<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a></td>
      <td><?php echo ($vo["truename"]); ?></td>
      <td><?php echo (date("Y-m-d",$vo["pub_time"])); ?></td>
      <td><a href="/vshow/index.php/Home/Course/s_ShowInterFlowInfo/courseId/<?php echo ($vo["course_id"]); ?>/interId/<?php echo ($vo["id"]); ?>">查看</a></td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
 </table>
</div>
    <div class="modal fade " id="notice-modal" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog" style="width:360px;">
        <div class="modal-content" style="height:400px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="mySmallModalLabel">我要提问</h4>
          </div>
          <div class="modal-body" style="  text-align: center;line-height: 60px;height: 100px;">
            <form style="width:250px;margin:0 auto;" id="question">
              <div class="input-group">
                <input type="text" class="form-control validate[required]" placeholder="问题" aria-describedby="basic-addon1" id="question-title" style="width:253px;">
              </div> 
              <p></p>
              <div class="input-group">
                <input name="" id="question-content" class="form-control" placeholder="描述" aria-describedby="basic-addon1" style="width:253px;height:200px;"/>
              </div>
              <input type="submit" class="btn btn-sm btn-success" id="question-button" courseId="<?php echo ($_GET['courseId']); ?>" value="提问" >
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
    $('#pub-notice-btn').click(function(){
        $('#notice-modal').modal(true);
      });
   $('#question').validationEngine({
    'custom_error_messages':{
      '#question-title' : {
        'required':{
          'message' : '* 请输入问题标题'
        }
      },
      '#question-content': {
        'required' : {
          'message': '* 请输入问题描述'
        }
      }
    },
    'onValidationComplete' : function(form,status){
      if (status === true) {
          var title    = $('#question-title').val();
          var content  = $('#question-content').val();
          var course_id = $('#question-button').attr('courseId'); 
          var __hash__ = $('input[name=__hash__]').val();

          $.post('/vshow/index.php/Home/Course/s_PubtInterflow',
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