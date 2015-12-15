<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title><?php echo ($user["truename"]); ?>个人中心</title>
     <link rel="stylesheet" type="text/css" href="/vshow/Public/style/Course/common.css">
    
    <!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="/vshow/Public/script/Plug/bootstrap/css/bootstrap.min.css">

<!-- 可选的Bootstrap主题文件（一般不用引入） -->
<link rel="stylesheet" href="/vshow/Public/script/Plug/bootstrap/css/bootstrap-theme.min.css">

<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="/vshow/Public/script/Common/jquery-1.10.2.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="/vshow/Public/script/Plug/bootstrap/js/bootstrap.js"></script>
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
			var active = "homeowork-li";
			console.log($("#"+active));
			$('.nav-tabs li').attr('class','');
			$("#"+active).addClass('active');
			
		})

	</script>	
  <div class="main">
   <table class="table table-hover tableList table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>作业名称</th>
            <th>作业要求</th>
            <th>截止时间</th>
            <th>作业状态</th>
            <th>操作</th>
        </tr>
        <?php if(is_array($homeworkList)): $i = 0; $__LIST__ = $homeworkList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$co): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($co["id"]); ?></td>
                <td><?php echo ($co["homework_name"]); ?></td>
                <td><a href="/vshow/index.php/Home/Course/s_ShowHomeworkInfo/homeworkId/<?php echo ($co["id"]); ?>/courseId/<?php echo ($_GET['courseId']); ?> ">查看</a></td> 
                <td><?php echo (date("Y-m-d",$co["homework_expires"])); ?></td>
                <td>
                <?php if($co["is_expires"] == 1): ?><a href="#">已截止</a>
                <?php else: ?>
                     <?php if($co["is_submit"] == null): ?><a href="#">未提交</a>
                        <?php else: ?>
                         <a href="#">已提交</a>
                       </td><?php endif; endif; ?>
                
                </td>  
                <td>
                    <?php if($co["is_expires"] == 1): ?><a href="javascript:;">无法提交</a>
                    <?php else: ?>
                      <?php if($co["is_submit"] == null): ?><a href="javascript:;" class="btn btn-primary btn-sm submitHomework" hid="<?php echo ($co["id"]); ?>">提交作业</a>
                      <?php else: ?>
                           <a href="javascript:;" class="btn btn-primary btn-sm submitHomework" hid="<?php echo ($co["id"]); ?>">修改作业</a>
                           <a href="javascript:;" class="btn btn-primary btn-sm  one-key" hid="<?php echo ($co["id"]); ?>">一键发布</a><?php endif; endif; ?>
                  </td>
                </if>
                

                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
  </div>

    <div class="modal fade bs-example-modal-sm submitModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content" style="  height: 200px;">

       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">提交文件</h4>

       </div>
            <div class="section-l fl" style="height:150px;">
            <p style="margin-top:50px;margin-left:280px">
            <center>
            <a href="javascript:;" class="btn btn-success btn-sm" id="selectFile" >选择文件</a>
             <input type="file" name="homework_file" id="homework_file" value="选择作业" style="display:none" /> </center>
             </p>
        </div>
      </div>
    </div>
    </div>

    <div class="modal fade " id="homework-modal" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog" style="width:460px;">
        <div class="modal-content" style="height:420px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="mySmallModalLabel">一键发布</h4>
          </div>
          <div class="modal-body" style="  text-align: center;line-height: 60px;height: 100px;">
            <form style="width:400px;margin:0 auto;" id="works">
              <div class="input-group">
                <input type="text" class="form-control validate[required]" placeholder="名称" aria-describedby="basic-addon1" id="works-title" style="width:400px;">
              </div> 
              <p></p>
              <div class="input-group">

                <textarea name="" id="works-content"  rows="8" class="form-control" style="width:400px;" placeholder="简介"></textarea>
              </div>
              <div class="input-group" style="margin-top:20px">
                <a href="javascript:;" class="btn btn-success btn-sm" id="selectPic" >选择截图</a>
             <input type="file" name="works_file" id="works_file" value="选择作业" style="display:none" /> 
              <span id="works-filename" style="margin-left:20px"></span>
              </div>
              <input type="submit" class="btn btn-sm btn-success" id="works-button" courseId="<?php echo ($_GET['courseId']); ?>" value="发布" style="margin-bottom:20px">
            </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

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
            var hid = null;
            
           $('.submitHomework').click(function(){
                hid = $(this).attr('hid');
                $('.submitModal').modal(true);
                // 
           });

           $('.one-key').click(function(){
                hid = $(this).attr('hid');
                $('#homework-modal').modal(true);
                // 
           });
           $('#selectPic').click(function(){
                $('#works_file').trigger('click');
           });

            $('#selectFile').click(function(){
                $('#homework_file').trigger('click');
           });
           $('#homework_file').on('change',function(){
              var data = new FormData();

              var homework_file = $("#homework_file")[0].files[0];

              data.append('homework_file',homework_file);
              data.append('homeworkId',hid);
              data.append('courseId',<?php echo ($_GET['courseId']); ?>);
 
              $.ajax({
                     type:"post",
                     url:'/vshow/index.php/Home/Course/s_PubHomework',
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
      $(document).on('change','#works_file',function(){
                  var $works_file = $("#works_file")[0].files[0];
                  $('#works-filename').html($works_file.name);
          });
           $('#works').on('submit',function(){
              var data = new FormData();

              var works_file = $("#works_file")[0].files[0];
              var works_title = $("#works-title").val();
              var works_content = $("#works-content").val();
              var __hash__ = $('input[name=__hash__]').val();

              data.append('works_file',works_file);
              data.append('title',works_title);
              data.append('content',works_content);
              data.append('__hash__',__hash__);
              data.append('homeworkId',hid);
              data.append('courseId',<?php echo ($_GET['courseId']); ?>);

              $.ajax({
                     type:"post",
                     url:'/vshow/index.php/Home/Works/OneKeyrRelease',
                     data: data,
                     processData: false,
                     contentType: false
                 }).done(function(res){
                $('#homework-modal').modal('hide');

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

                return false;
           })
        })
    </script>
</body>
</html>