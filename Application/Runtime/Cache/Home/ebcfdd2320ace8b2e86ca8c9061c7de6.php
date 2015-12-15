<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title><?php echo ($user["truename"]); ?>个人中心</title>
    <script type="text/javascript">var root = "/vshow/index.php";</script>
     <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Course/common.css">
       <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Plug/Validation-Engine/validationEngine.jquery.css">
    <link rel="stylesheet" href="/vshow/Public/script/Plug/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/vshow/Public/script/Plug/bootstrap/css/bootstrap-theme.min.css">
    <script src="/vshow/Public/script/Common/jquery-1.10.2.js"></script>
    <script src="/vshow/Public/script/Plug/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Plug/Validation-Engine/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Plug/Validation-Engine/jquery.validationEngine-zh_CN.js"></script>
    <script type="text/javascript" src="/vshow/Public/script/Plug/laydate/laydate.dev.js"></script>

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
			var active = "homeowork-li";
			console.log($("#"+active));
			$('.nav-tabs li').attr('class','');
			$("#"+active).addClass('active');
			
		})

	</script>	
    <div class="main">
    
      <div class="pub-area">
           <a href="javascript:;" class="btn btn-success sub-button" id="pubHomework">发布作业</a>
      </div>


  <table class="table table-hover tableList table-striped table-bordered">
    <tr>
        <th>ID</th>
        <th>作业名称</th>
        <th>作业要求</th>
        <th>截止时间</th>
        <th>操作</th>
    </tr>
    <?php if(is_array($homeworkList)): $i = 0; $__LIST__ = $homeworkList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$co): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($co["id"]); ?></td>
            <td><?php echo ($co["homework_name"]); ?></td>
            <td><a href="/vshow/index.php/Home/Course/s_ShowHomeworkInfo/homeworkId/<?php echo ($co["id"]); ?>/courseId/<?php echo ($_GET['courseId']); ?> ">查看</a></td> 
            <td><?php echo (date("Y-m-d",$co["homework_expires"])); ?></td>
            <td>
            <a href="javascript:;" class="btn btn-success btn-sm">编辑</a>
            <a href="/vshow/index.php/Home/Course/t_HomeworkManage/courseId/<?php echo ($_GET['courseId']); ?>/homewokrId/<?php echo ($co["id"]); ?>" class="btn btn-success btn-sm">管理</a>
            </td>  
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>

</div>
    <div class="modal fade bs-example-modal-sm submitModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content" style="width:350px;height:320px;">

       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">发布作业</h4>

       </div>
          <form id="homework_add">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">作业名称</span>
              <input type="text" name="homework_name" id="homework_name" class="validate[required,maxSize[12]] form-control"> 
            </div>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">作业要求</span>
              <textarea class="form-control" name="homework_about" id="homework_about" rows="3" class="validate[required,maxSize[200] form-control"></textarea>
            </div>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">截止时间</span>
              <input type="text" name="homework_expires" id="homework_expires" class="validate[required] form-control">  
            </div>
            <input type="submit" value="新增作业" class="btn btn-success btn-home">
            <input type="hidden" value="<?php echo ($_GET['courseId']); ?>" name="course_id">
          </form>
      </div>
    </div>
    </div>
    <div class="modal fade bs-example-modal-sm" id="message" tabindex="-1" role="dialog"  aria-hidden="true">
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
        
           $('#pubHomework').click(function(){
                $('.submitModal').modal(true);
                // 
           });
           $(function(){
/*  $(document).on('click','#modify_pwd',function(){
        var $pwd   = $("input[name=pwd]")[0];
        var $rqpwd = $("input[name=rqpwd]")[0];
    });*/ 
        laydate({
            elem: '#homework_expires'
        });

        $('#homework_add').validationEngine({
            'custom_error_messages':{
                '#homework_name' : {
                    'required':{
                        'message' : '* 请输入作业名称'
                    }
                },
                '#homework_about': {
                    'required' : {
                        'message': '* 请输入作业要求'
                    }
                },
                 '#homework_expires': {
                    'required' : {
                        'message': '* 请选择截止时间'
                    }
                }
            },
            'onValidationComplete' : function(form,status){
                if (status === true) {
                    var $data = $('#homework_add').serialize();
                  
                   $.post('/vshow/index.php/Home/Course/addHomework',$data,function(data,status){
                    $('.submitModal').modal('hide');
                    if (data.status == 0 ) {
                          $('#message .modal-body').text(data.message);
                          $('#message').modal(true);
                      }else{
                           $('#message .modal-body').text(data.message);
                           $('#message').modal(true);
                             setTimeout(function(){
                          $('#message').modal('hide');
                          location.reload(true);
                       },1500)
                       }
                   })
                }
            },
            // 'ajaxFormValidation' : true,
            'ajaxFormValidationMethod' : 'post'
    }); 
});


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