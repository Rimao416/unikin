$(function(){
    $(document).on('click','#lessons_id',function(){
        var attribute=$(this).data('courses_id')
            console.log(attribute)
        var idName='sub__courses'+attribute
        action="load_courses";
        $.ajax({
            url:"include/student/cours_action.php",
            method:"post",
            data:{action:action,attribute:attribute},
            beforeSend:function(){
                $('.'+idName).slideToggle()
            },
            success:function(data){
                $('.'+idName).html(data)
            }
        })
    })
})