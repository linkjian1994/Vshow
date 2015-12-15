<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>后台管理系统</title>
	<meta charset="UTF-8">
   <link rel="stylesheet" type="text/css" href="/vshow/Public/admin/Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/vshow/Public/admin/Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/vshow/Public/admin/Css/style.css" />
    <script type="text/javascript" src="/vshow/Public/admin/Js/jquery.js"></script>
    <script type="text/javascript" src="/vshow/Public/admin/Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/vshow/Public/admin/Js/bootstrap.js"></script>
    <script type="text/javascript" src="/vshow/Public/admin/Js/ckform.js"></script>
    <script type="text/javascript" src="/vshow/Public/admin/Js/common.js"></script>
    <style type="text/css">
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            max-width: 300px;
            padding: 19px 29px 29px;
            margin: 0 auto 20px;
            background-color: #fff;
            border: 1px solid #e5e5e5;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
        }

        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }

        .form-signin input[type="text"],
        .form-signin input[type="password"] {
            font-size: 16px;
            height: auto;
            margin-bottom: 15px;
            padding: 7px 9px;
        }

    </style>  
</head>
<body>
<div class="container">

    <form class="form-signin" method="post" action="/vshow/admin.php/User/dologin">
        <h2 class="form-signin-heading">登录系统</h2>
        <input type="text" name="username" class="input-block-level" placeholder="账号">
        <input type="password" name="password" class="input-block-level" placeholder="密码">
        <input type="text" name="verifyCode" class="input-medium" placeholder="验证码"><img src="/vshow/admin.php/Home/getVerifyCode" alt="" class="verifyCodeImg" id="verifyCodeImg" />
        <br/>
        <a href="javascript:;" id="getVerifyCode">看不清？点击换一张</a>
        <p><button class="btn btn-large btn-primary" type="submit" style="margin-left:100px;">登录</button></p>
    </form>
    <script type="text/javascript">
    $(function(){
        $(document).on('click','#getVerifyCode',function(){
        $('#verifyCodeImg').attr('src','/vshow/admin.php/Home/getVerifyCode?r='+Math.random());
    })
    })
    </script>
</div>
</body>
</html>