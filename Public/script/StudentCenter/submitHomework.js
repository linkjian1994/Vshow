$(function(){

    $(document).on('change','#works-file',function(){
            var $works_file = $("#works-file")[0].files[0];
            $('#works-filename').html($works_file.name);
    });

    $(document).on('change','#works-images',function(){
            var $works_images = $("#works-images")[0].files[0];
            $('#works-imgname').html($works_images.name);
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

                    var works_name  = document.getElementById('works-name').value;
                    var works_about = document.getElementById('works-about').value;
                    // var works_label = document.getElementById('works-label').value;
                    var homeworkID  = document.getElementById('homeworkID').value;
                    var __hash__    = document.getElementsByName('__hash__')[1].value;

                    var works_file = $("#works-file")[0].files[0];
                    var works_images = $("#works-images")[0].files[0];

                    data.append('works_name',works_name);
                    data.append('works_about',works_about);
                    data.append('homework_id',homeworkID);
                    data.append('works_file[]',works_file);
                    data.append('works_file[]',works_images);
                    data.append('__hash__',__hash__);

                    $.ajax({
                           type:"post",
                           url:"/vshow/index.php/Home/Works/worksAddAction",
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
                                var $d = D('作品发布成功，正在跳转','right').showModal();
                                setTimeout(function () {
                                    $d.close();
                                    location.href = root+'/Home/StudentCenter/homework';
                                }, 2000);
                            }
                     });
                }
            },
            // 'ajaxFormValidation' : true,
            'ajaxFormValidationMethod' : 'post'
    });
function D(content,direction){
    var d = dialog({
        align : direction,
        content : content,

    })
    return d;
}
})