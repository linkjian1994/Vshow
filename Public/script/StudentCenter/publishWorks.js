seajs.config({
  alias: {
    "jquery": "jquery-1.10.2.js"
  }
});

$(function(){

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
                        
                    var data = new FormData();

                    var works_name = document.getElementById('works-name').value;
                    var works_about = document.getElementById('works-about').value;
                    var works_label = document.getElementById('works-label').value;
                    var __hash__ = document.getElementsByName('__hash__')[1].value;

                    var works_file = $("#works-file")[0].files[0];
                    var works_images = $("#works-images")[0].files[0];


                    // console.log(__hash__);return false;
                    data.append('works_name',works_name);
                    data.append('works_about',works_about);
                    data.append('works_label',works_label);
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

    $('input[name=is-homework]').click(function(){
        var is_homework = $(this).val();

        var $iframe = $('<iframe src="/vshow/index.php/Home/StudentCenter/getUserHomework" frameborder="0" width="1024" height="500"></iframe>')
  
        if (is_homework == 1) {
            var selectHomework = dialog({
                title : '选择课程',
                content : $iframe,
                width : 1024,
                height: 500,
                okValue:'确定',
                cancelValue :'取消',
                url:'./publishWorks',
                ok:function(){
                   /* this.close();
                    location.href = location.href;*/
                },
                cancel:function(){
                    // this.close();
                    // location.href = location.href;
                }
            });

            selectHomework.showModal();
        }
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
})