$(function(){
    var passDia = null;

      $('#login-form').validationEngine({
            'custom_error_messages':{
                '#uname' : {
                    'required':{
                        'message' : '* 请输入用户名'
                    }
                },
                '#pwd': {
                    'required' : {
                        'message': '* 请输入密码'
                    }
                }
            },
            'onValidationComplete' : function(form,status){
                if (status === true) {
                    var message = dialog({
                        content: '正在登录中，请稍后..'
                    }).showModal();
                   
                    var $loginData = $('#login-form').serialize();
                    // console.log($loginData);return false;
                    $.post(root+'/Home/User/dologin',$loginData,function(data,status){
                        if (data.status == '0') {
                            message.close();
                            $('#msg').css('color','red');
                            $('#msg').html(data.message);
                        }else{
                            message.close();
                            window.location.href = root;
                        }
                    })
                        
                }
            },
            // 'ajaxFormValidation' : true,
            'ajaxFormValidationMethod' : 'post'
    });     
        $('#forgetForm').validationEngine({
            'onValidationComplete' : function(form,status){
                if (status === true) {
                    var message = dialog({
                        content: '正在发送邮件'
                    }).showModal();
                   
                    var $forgetData = $('#forgetForm').serialize();
                    // console.log($loginData);return false;
                    $.post(root+'/Home/User/getPassword',$forgetData,function(data,status){
                        if (data.status == '0') {
                            $('.error-msg').html(data.message);
                        }else{
                            passDia.close();
                            message.close();
                            var d = dialog({
                                title: '提示',
                                content: data.message
                            });
                            d.showModal();
                            setTimeout(function(){
                                d.close();
                                location.reload(true);
                            },2000)
                        }
                        console.log(data);
                    });    
                }
            },
            // 'ajaxFormValidation' : true,
            'ajaxFormValidationMethod' : 'post'
    }); 
    $(document).on(
        'click',
        '#forgetPass',
        function()
        {  
           var $forgetDiv = $('#forgetForm');
           passDia = dialog({
                title : '找回密码',
                content :$forgetDiv,
                width:400,
                height:250
           }).showModal();
        })
})