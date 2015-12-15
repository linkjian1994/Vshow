$(function(){
    $(document).on('click','.take-course-button',function(){
        var $courseID = $(this).attr('course-id');
        $.post('/vshow/index.php/Home/StudentCenter/takeCourseAction'
            ,{courseID:$courseID}
            ,function(data, status){
                console.log(data);
            })
    })
})