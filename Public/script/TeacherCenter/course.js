$(function(){
/*  $(document).on('click','#modify_pwd',function(){
        var $pwd   = $("input[name=pwd]")[0];
        var $rqpwd = $("input[name=rqpwd]")[0];
    });*/ 
        $('#course_add').validationEngine({
            'custom_error_messages':{
                '#course_name' : {
                    'required':{
                        'message' : '* 请输入课程名称'
                    }
                },
                '#course_about': {
                    'required' : {
                        'message': '* 请输入课程简介'
                    }
                }
            },
            'onValidationComplete' : function(form,status){
                if (status === true) {
                    var message = dialog({
                        content: '正在添加课程，请稍等'
                    }).showModal();
                        
                    var data = new FormData();

                    var course_name = document.getElementById('course_name').value;
                    var course_about = document.getElementById('course_about').value;
                    var __hash__ = document.getElementsByName('__hash__')[1].value;
                    var course_image = $("#course_image")[0].files[0];
                    // console.log(__hash__);return false;
                    data.append('course_name',course_name);
                    data.append('course_about',course_about);
                    data.append('course_image',course_image);
                    data.append('__hash__',__hash__);

                    $.ajax({
                           type:"post",
                           url:"/vshow/index.php/Home/TeacherCenter/CourseAddAction",
                           data: data,
                           processData: false,
                           contentType: false
                       }).done(function(res){
                            message.close();
                            if (res.status == 0 ) {
                                D(res.message,'right').showModal();
                            }else{
                                var resMessage = dialog({
                                    title : '提示',
                                    content : res.message,
                                    width : 347,
                                    height: 180,
                                    okValue:'确定',
                                    cancelValue :'取消',
                                    ok:function(){
                                        this.close();
                                        location.href = location.href;
                                    },
                                    cancel:function(){
                                        this.close();
                                        location.href = location.href;
                                    }
                                });
                                resMessage.showModal();
                            }
                     });
                }
            },
            // 'ajaxFormValidation' : true,
            'ajaxFormValidationMethod' : 'post'
    }); 
});


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
