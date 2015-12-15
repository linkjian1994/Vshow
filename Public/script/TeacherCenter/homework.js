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

