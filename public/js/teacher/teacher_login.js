$(function(){
    $('#teacher_login_form').on('submit',function(event){
        event.preventDefault();
        $.ajax({
            url:"../include/teacher/check_teacher_login.php",
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            beforeSend:function(){
                $('#teacher_login').val('Validation ...')
                $('#teacher_login').attr('disabled','disabled')
            },success:function(data)
            {
                if(data.success){
   
                    $('.main').css('display','none')
                    var action='load_action';
                    $.ajax({
                        url:'../include/teacher/check_teacher_login.php',
                        method:"POST",
                        data:{action:action},
                        success:function(donnee)
                        {
                            $('#container').html(donnee)
                        }
                    })
                }
                if(data.error){
                    $('#teacher_login').val('Connexion')
                    $('#teacher_login').attr('disabled',false)
                    if(data.error_teacher_emailid != ''){
                        $('#error_teacher_emailid').text(data.error_teacher_emailid)
                    }else{
                        $('#error_teacher_emailid').text('')
                    }
                    if(data.error_teacher_password !=''){
                        $('#error_teacher_password').text(data.error_teacher_password)
                    }else{
                        $('#error_teacher_password').text('')
                    }
                }
            }
        })
    })

$(document).on('click','#card1',function(){
    var grade_id=$(this).data('grade_id');
    var action='classe';
    $.ajax({
        url:"../include/teacher/check_teacher_login.php",
        method:"POST",
        data:{action:action,grade_id:grade_id},
        success:function(data){
            $('.main').css('display','none')
            $('#container').css('display','none')
            $('#container2').html(data)
        }
    })
})

$(document).on('click','#card2',function(){
    var matiere_id=$(this).data('matiere_id');
    var action='matiere';
    $.ajax({
        url:"../include/teacher/check_teacher_login.php",
        method:"POST",
        data:{action:action,matiere_id:matiere_id},
        success:function(data){
            location.href="index.php";
        }
    })
})

})