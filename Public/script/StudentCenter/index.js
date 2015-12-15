$(function(){
/*	$(document).on('click','#modify_pwd',function(){
		var $pwd   = $("input[name=pwd]")[0];
		var $rqpwd = $("input[name=rqpwd]")[0];
	});*/
    $(document).on('submit','#modify_avater',function(){
        return false;
    });

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
    
    // 作品上传
      $('#worksUpload').validationEngine({
            'custom_error_messages':{
                '#works-name' : {
                    'required':{
                        'message' : '* 请输入作品名称'
                    }
                },
                '#works-file' : {
                    'required':{
                        'message' : '* 请选择作品文件'
                    }
                },
                 '#works-images' : {
                    'required':{
                        'message' : '* 请选择作品截图'
                    }
                },
                
            },
            'onValidationComplete' : function(form,status){
                if (status === true) {
                    var message = dialog({
                        content: '正在发布作品，请稍等O(∩_∩)O'
                    }).showModal();
                    // return false;
                        
                    var data = new FormData();

                    var works_name = document.getElementById('works-name').value;
                    var works_about = document.getElementById('works-about').value;
                    var works_label = document.getElementById('works-label').value;
                    var __hash__ = document.getElementsByName('__hash__')[1].value;

                    var works_file = $("#works-file")[0].files[0];
                    var works_images = $("#works-images")[0].files[0];


                    console.log(works_name);
                    console.log(works_about);
                    console.log(works_label);
                    console.log(__hash__);
                    console.log(works_file);
                    console.log(works_images);

                    data.append('works_name',works_name);
                    data.append('works_about',works_about);
                    data.append('works_label',works_label);
                    data.append('works_file[]',works_file);
                    data.append('works_file[]',works_images);
                    data.append('__hash__',__hash__);


                    $.ajax({
                           type:"post",
                           url:root+'/Home/Works/worksAddAction',
                           data: data,
                           processData: false,
                           contentType: false
                       }).done(function(res){
                            message.close();
                            if (res.status == 0 ) {
                                D(res.message,'right').showModal();
                            }else{
                         /*       var resMessage = dialog({
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
                                resMessage.showModal();*/
                                setTimeout(function(){
                                     location.reload(true);  
                                },1500);
                                D('作品发布成功，正在跳转','right').showModal();

                               
                            }
                     });
                }
            },
            // 'ajaxFormValidation' : true,
            'ajaxFormValidationMethod' : 'post'
    });
    
    $(document).on('click','.viewHomework',function(){
        var $courseID = $(this).attr('course-id');
        // alert($courseID);

        $iframe = $('<iframe width="1024px" height="600px" src="'+root+'/Home/StudentCenter/getUserHomework/courseID/'+$courseID+'" frameborder="0"></iframe>');

        dialog({
            title: '选择作业',
            width:1024,
            height:600,
            content:$iframe,
        
           
        }).showModal();  
    });

   $(document).on('click','.delete-works',function(){
        // alert(1);return false;
        var worksID = $(this).attr('wid');
        var $wokrsInfo =$(this).parent().parent().parent().parent();
        $.post(root+'/Home/Works/deleteWorks',{id : worksID},function(data,status){
            if (data.status == '1') {
                D(data.message,'right').showModal();
                $wokrsInfo.remove();
            }else{
                D(data.message,'right').showModal();
            }
        });
    }); 

    $(document).on('click','.edit-works',function(){
        var worksID = $(this).attr('wid');
        $.post(root+'/Home/Works/getEditWorksInfo',{id : worksID},function(data,status){
            var works_name = data.works_name;
            var works_about = data.works_about;
            var works_label = data.works_label;
            var editWorksDialog = dialog({
                title : '编辑作品',
                content :$('<ul class="editWorks"><li><span>作品名称</span><span><input type="text" value="'+data.works_name+'" name="works-name2"></span></li><li><span>作品简介</span><span><input type="text" value="'+data.works_about+'" name="works-about2"></span></li><li><span>作品标签</span><span><input type="text" value="'+data.works_label+'" name="works-label2"></span></li></ul>'
                ),
                width : 347,
                height: 160,
                okValue:'确定',
                cancelValue:'取消',
                // cancelValue :'取消',
                ok:function(){
                    var editWorksName = $('input[name=works-name2]').val();
                    var editWorksAbout = $('input[name=works-about2]').val();
                    var editWorksLabel = $('input[name=works-label2]').val();
                    console.log(editWorksName);
                    console.log(editWorksAbout);
                    console.log(editWorksLabel);
                    if (editWorksName == works_name && editWorksAbout == works_about && editWorksLabel == works_label) {
                        D('未作出更改').showModal();
                    }else{
                        $.post(root+'/Home/Works/editWorks',{
                            id : worksID,
                            works_name:editWorksName,
                            works_about:editWorksAbout,
                            works_label:editWorksLabel,
                        },function(data,status){
                            if (data.status == '1') {
                                D(data.message,'right').showModal();
                            }else{
                                D(data.message,'right').showModal();
                            }
                        });
                    }
                },
                cancel:function(){
                    this.close();
                },
            });
            editWorksDialog.showModal();
        });
    });

    $(document).on('click','.delete-collect',function(){
        var oid = $(this).attr('oid');
        var wid = $(this).attr('wid');
        var $wokrsInfo =$(this).parent().parent().parent().parent();
        $.post(root+'/Home/Works/deleteCollect',{oid : oid,wid:wid},function(data,status){
            if (data.status == '1') {
                D(data.message,'right').showModal();
                $wokrsInfo.remove();
            }else{
                D(data.message,'right').showModal();
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
                    var regMsg = dialog({
                        content: '正在添加作业，请稍等'
                    }).showModal();

                    var $data = $('#homework_add').serialize();
                   $.post('/vshow/index.php/Home/Course/addHomework',$data,function(data,status){
                    if (data.status == 0) {
                        D('<span style="color:red;">'+data.message+'</span>','right').showModal();
                    }else{
                        regMsg.close();
                        D('<spans>'+data.message+'</span>','right').showModal();
                        setTimeout("location.href=location.href",2000);
                    }
                   })
                }
            },
            // 'ajaxFormValidation' : true,
            'ajaxFormValidationMethod' : 'post'
    });

    $(document).on('click','.take-course-button',function(){
        var $courseID = $(this).attr('course-id');
        $.post('/vshow/index.php/Home/StudentCenter/takeCourseAction'
            ,{courseID:$courseID}
            ,function(data, status){
                if(data.status == '0')
                {
                    D(data.message).showModal();
                }else{
                    D(data.message).showModal();
                }
            })
    }); 
});

function setCoords(c){
	$('#x').val(c.x);
	$('#y').val(c.y);
	$('#w').val(c.w);
	$('#h').val(c.h);
}

function D(content,direction){
	var d = dialog({
		align : direction,
		content : content,
        okValue:'确定'
	})

	setTimeout(function () {
		d.close();
	}, 1500);

	return d;
}

function checkNewPwd(field, rules, i, options)
{	
	if (field.val() == $('#password').val()) 
	{
		return options.allrules.checkNewPwd.alertText;
	};
}
