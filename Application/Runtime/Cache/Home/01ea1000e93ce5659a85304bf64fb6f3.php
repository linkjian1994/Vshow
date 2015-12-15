<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <title>个人中心</title>
  <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Course/common.css">
  <link rel="stylesheet" href="/vshow/Public/script/Plug/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/vshow/Public/script/Plug/bootstrap/css/bootstrap-theme.min.css">
  <script src="/vshow/Public/script/Common/jquery-1.10.2.js"></script>
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
	   <li role="presentation" id="notice-li"><a href="/vshow/index.php/Home/Course/s_Index/courseId/<?php echo ($_GET['courseId']); ?>">课程公告</a></li>
	  <li role="presentation" id="resource-li"><a href="/vshow/index.php/Home/Course/s_ShowResource/courseId/<?php echo ($_GET['courseId']); ?>">课程资源</a></li>
	  <li role="presentation" id="interflow-li"><a href="/vshow/index.php/Home/Course/s_ShowInterflow/courseId/<?php echo ($_GET['courseId']); ?>">互动交流</a></li>
	  <li role="presentation" id="homeowork-li"><a href="/vshow/index.php/Home/Course/s_ShowHomework/courseId/<?php echo ($_GET['courseId']); ?>">课程作业</a></li>
	</ul>
	<script type="text/javascript">
		$(function(){
			var active = "resource-li";
			console.log($("#"+active));
			$('.nav-tabs li').attr('class','');
			$("#"+active).addClass('active');
			
		})

	</script>	
  <div class="main">
    
      <div class="pub-area">
         
      </div>
   <table class="table table-hover tableList table-striped table-bordered">
    <tr>
        <th>名称</th>
        <th>操作</th>
        <th>发布人</th>
        <th>发布时间</th>
        <th>大小</th>
    </tr>
      <?php if(is_array($resourceList)): $i = 0; $__LIST__ = $resourceList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$res): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($res["title"]); ?></td>
            <td><a href="/vshow/<?php echo ($res["file_path"]); ?>">下载</a></td>
            <td><?php echo ($res["teacher_name"]); ?></td> 
            <td><?php echo (date("Y-m-d",$res["pub_time"])); ?></td>
            <td><?php echo ($res["file_size"]); ?></td> 
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
</div>

    <div class="modal fade bs-example-modal-sm submitModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content" style="width:340px;height:200px;">

       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">发布资源</h4>

       </div>
             <div class="input-group" style="margin:20px;">
              <span class="input-group-addon" id="basic-addon1">名称</span><input type="text" class="form-control validate[required]" placeholder="标题" aria-describedby="basic-addon1" style="width:200px;" name="title" id="res-title">
              </div>
              <p></p>
              <div class="section-l fl" style="height:150px;">
                <p style="margin-left:120px;">
                <a href="javascript:;" class="btn btn-success btn-sm" id="selectFile" >选择文件</a>
                <input type="file" name="homework_file" id="homework_file" value="选择作业" style="display:none" />
                 </p>
           
              </div>
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
        $(function(){
           $('.sub-button').click(function(){
                $('.submitModal').modal(true);
                // 
           });
           $('#selectFile').click(function(){
                if ($('#res-title').val() == '') {
                    alert('请填写名称');
                    return false;
                };
                $('#homework_file').trigger('click');
           });
           $('#homework_file').on('change',function(){
              var data = new FormData();

              var homework_file = $("#homework_file")[0].files[0];

              data.append('res_file',homework_file);
              data.append('title',$('#res-title').val());
              data.append('courseId',<?php echo ($_GET['courseId']); ?>);
 
              $.ajax({
                     type:"post",
                     url:'/vshow/index.php/Home/Course/t_PubResource',
                     data: data,
                     processData: false,
                     contentType: false
                 }).done(function(res){
                      $('.submitModal').modal('hide');
                       if (res.status == 0 ) {
                          $('#message .modal-body').text(res.message);
                          $('#message').modal(true);
                      }else{
                           $('#message .modal-body').text(res.message);
                           $('#message').modal(true);
                             setTimeout(function(){
                          $('#message').modal('hide');
                          location.reload(true);
                       },1500)
                       }

               });
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