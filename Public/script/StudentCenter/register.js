$(function(){
	$('#regdata').validationEngine({
		'custom_error_messages':{
			'#username': {
				'required' : {
					'message': '* 请输入用户名'
				}
			},
			'#password': {
				'required' : {
					'message': '* 请输入密码'
				}
			},
			'#rqpassword': {
				'required' : {
					'message': '* 请确认你的密码'
				}
			},
			'#mail': {
				'required' : {
					'message': '* 请输入你的邮箱'
				}
			},
			/*'#stuid': {
				'required' : {
					'message' : '* 请输入学号'
				},
				'custom[number]' : {
					'message': '* 学号格式不正确'
				}
			},*/
			'#truename': {
				'required' : {
					'message' : '* 请输入姓名'
				},
			},
		/*	'#user-dep': {
				'required' : {
					'message' : '* 请选择系别'
				},
			},*/
		/*	'#user-cla': {
				'required' : {
					'message' : '* 请选择班级'
				},
			},
			'#user-spe': {
				'required' : {
					'message' : '* 请选择专业'
				},
			},*/
		},
		'onValidationComplete' : function(form,status){
			if (status === true) {
				var regMsg = dialog({
    				content: '正在注册中，请稍等'
				}).showModal();
				
				var $regdata = $('#regdata').serialize();

				$.post('/vshow/index.php/Home/User/doRegister',$regdata,function(data,status){
					if (data.status == 0) {
						D('<span style="color:red;">'+data.massge+'</span>','right').show();
					}else{
						regMsg.close();
						var message = dialog({
				            title : '提示',
				            content : data.msg,
				            width : 347,
				            height: 180,
				        	okValue:'确定',
				        	cancelValue :'取消',
				        	ok:function(){
				        		this.close();
				        		location.href = '/vshow/Home/User/login';
				        	},
				            cancel:function(){
				            	this.close();
				        		location.href = '/vshow/Home/User/login';
				            }
				        });
				        message.showModal();
					}
				})
			}
		},
		// 'ajaxFormValidation' : true,
		'ajaxFormValidationMethod' : 'post'
}); 

	// 
	$(document).on('click','#getVerifyCode',function(){
		$('#verifyCodeImg').attr('src','/vshow/Home/User/getVerifyCode?r='+Math.random());
	})

	$(document).on('change','.user-class',function(){
		var $selectedValue = $(this).val();
		var $selectedId    = $(this).attr('id');
		switch($selectedId)
		{
			case 'user-dep' : sendAjax('department',$selectedValue,$selectedId); break;
			case 'user-spe' : sendAjax('specialty',$selectedValue,$selectedId);  break;
		}
	});

	function sendAjax(type,value,id){
		$.post('/NewVshow/Home/User/getClass',{
			selectType  : type,// depeartment
			selectValue : value,// 1
		},function(data,textstatus){
			if (id == 'user-dep') {
				$('#user-spe').empty();
				$('#user-spe').append('<option value="">选择专业</option>');
				for( i in data ){
					$('#user-spe').append('<option value="'+data[i].id+'">'+data[i].specialty+'</option>');
				}				
			};

			if (id == 'user-spe') {
				$('#user-cla').empty();
				$('#user-cla').append('<option value="">选择班级</option>');
				for( i in data ){
					$('#user-cla').append('<option value="'+data[i].id+'">'+data[i].class+'</option>');
				}				
			};
			
		})
	}

	// 快速创建气泡提示
	function D(content,direction){
		var d = dialog({
			align : direction,
			content : content,
		})

		setTimeout(function () {
    		d.close();
		}, 3000);

		return d;
	}
})