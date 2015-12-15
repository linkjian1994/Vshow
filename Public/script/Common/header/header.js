$(function(){
	// 绑定登录按钮
	$(document).on('click','#login_button a',function(){
		var $loginBox = $('#loginBox');
		var loding = new Object();
		if ($loginBox.is(':hidden')) {
			$loginBox.show();
		};
     	var loginBox = dialog({
            title : '登录',
            content : $loginBox,
            width : 347,
            height: 180,
            statusbar : '<label><input name="me" type="checkbox">记住我</label>',
        	okValue:'登录',
        	ok:function(){
        		var username = document.getElementsByName('username')[0];
                var password = document.getElementsByName('password')[0];
        		var me       = document.getElementsByName('me')[0];
        
        		if ($.trim(username.value) == '') {
        			D('<span style="color:red;">用户名不能为空</span>','right').show(username);
        			return false;
        		}
        		if ($.trim(password.value) == '') {
        			D('<span style="color:red;">密码不能为空</span>','right').show(password);
        			return false;
        		};

        		$.ajax({
        			url  : '/NewVshow/Home/User/Login', 
        			type : 'POST',
        			data : { username : username.value, password : password.value, me : me.checked},
        			dataType : 'JSON',
        			beforeSend : function(){
        				loding = dialog({cancel:false,title:'正在登录，请稍后...',width:142,height:90}).showModal();
        			},
        			success : function(data,textStatus){
        				if (data.status == 0) {
        					loding.close();
        					D('<span style="color:red;">'+data.msg+'</span>','right').show(username);
        				}else{
        					location.reload(true);
        				}
        			}
        		})

        		return false;
        	},
            cancelValue : '取消',
            cancel:function(){
            	this.close();
                return false;
            }
        });
        loginBox.showModal();
    })
	
	// 快速创建气泡提示
	function D(content,direction){
		var d = dialog({
			align : direction,
			content : content,
		})

		setTimeout(function () {
    		d.close();
		}, 2000);

		return d;
	}
})

	
