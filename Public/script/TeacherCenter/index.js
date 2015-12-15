
$(function(){
    $(document).on('change','#works-file',function(){
            var $works_file = $("#works-file")[0].files[0];
            $('#works-filename').html($works_file.name);
    });

    $(document).on('change','#works-images',function(){
            var $works_images = $("#works-images")[0].files[0];
            $('#works-imgname').html($works_images.name);
    });

    $('#modify_pwd').validationEngine({
        'custom_error_messages':{
            '#password' : {
                'required':{
                    'message' : '* 请输入原密码'
                }
            },
            '#new_password': {
                'required' : {
                    'message': '* 请输入新的密码'
                }
            },
            '#rq_password': {
                'required' : {
                    'message': '* 请确认新的密码'
                }
            }
        },
        'onValidationComplete' : function(form,status){
            if (status === true) {
                var message = dialog({
                    content: '正在更改密码，请稍等'
                }).showModal();
                
                var $modify = $('#modify_pwd').serialize();

                $.post(root+'/Home/User/modifyPwd',$modify,function(data,status){
                    // console.log(data);return;
                    if (data.status == 0) {
                        message.close();
                        D('<span style="color:red;">'+data.message+'</span>','right').show();
                    }else{
                        message.close();
                        var Redictmessage = dialog({
                            title : '提示',
                            content : '密码更改成功，请重新登录。即将跳转至登录页面',
                            width : 347,
                            height: 60,
                            okValue:'确定',
                            // cancelValue :'取消',
                            ok:function(){
                                this.close();
                                location.href = root+'/Home/User/login';
                            },
                            cancel:function(){
                                this.close();
                                location.href = root+'/Home/User/login';
                            },
                            cancelDisplay:false
                        });
                        Redictmessage.showModal();
                        setTimeout(function(){
                            Redictmessage.close();
                            location.href = root+'/Home/User/login';
                        },2000)
                    }
                });
            }
        },
        // 'ajaxFormValidation' : true,
        'ajaxFormValidationMethod' : 'post'
    }); 

        var jcrop_api = '';
        $(document).on('change','#avater',function(){
            var avater = $("#avater")[0].files[0];
            $('#avater_image').attr('src',window.URL.createObjectURL(avater));
            $('#avater_image').attr('width','320px');
            $('#avater_image').attr('height','240px');

            if (jcrop_api != '') {
                jcrop_api.destroy();
            };
            $('#avater_image').Jcrop({
                onChange: setCoords,
                aspectRatio : 1.2
            }, function(){
                jcrop_api = this;
            });
    })


       $(document).on('submit','#modify_avater',function(){
        if ($('#w').val() == '') {
            D('<span style="color:red;">'+'请裁剪头像后再上传'+'</span>','right').showModal();
            return false;
        }
        var message = dialog({
             content: '正在更改头像，请稍等O(∩_∩)O'
        }).showModal();

        var data = new FormData();

        var $coords_w   =    $('#w').val();
        var $coords_h   =    $('#h').val();
        var $coords_x   =    $('#x').val();
        var $coords_y   =    $('#y').val();
        var $images_w   =    $('#avater_image').attr('width');
        var $images_h   =    $('#avater_image').attr('height');
        var $avater     =    $("#avater")[0].files[0];

        var __hash__ = document.getElementsByName('__hash__')[1].value;
        
        data.append('coords_w',$coords_w);
        data.append('coords_h',$coords_h);
        data.append('coords_x',$coords_x);
        data.append('coords_y',$coords_y);
        data.append('images_w',$images_w);
        data.append('images_h',$images_h);
        data.append('avater',$avater);
        data.append('__hash__',__hash__);

        $.ajax({
               type:"post",
               url:root+"/Home/User/modifyAvater",
               data: data,
               processData: false,
               contentType: false
           }).done(function(res){
                if (res.status == '0') {
                    message.close();
                    D('<span style="color:red;">'+res.message+'</span>','right').showModal();
                }else{
                    message.close();
                    D('<span style="color:red;">'+res.message+'</span>','right').showModal();
                       location.reload(true);  
                }
        });
    });
       $(document).on('click','#edit-sign-button',function(){
        $oldSign = $('#edit-sign').attr('placeholder');
        $newSign = $('#edit-sign').val();
        var __hash__ = document.getElementsByName('__hash__')[1].value;

        if ($newSign == '') {
            D('请填写签名','right').showModal();
            return false; 
        };
        if ($oldSign == $newSign) {
            D('没有作出更改哦','right').showModal();
            return false;            
        };
        $.post(root+'/Home/User/editSign',{sign:$newSign,__hash__ : __hash__},function(data,status){
            if (data.status == '1') {
                D(data.message,'right').showModal();
                $oldSign = $newSign;
            }else{
                D(data.message,'right').showModal();
            }
        });
    }); 

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
})
 