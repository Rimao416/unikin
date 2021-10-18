$(function(){
    $('#student_login_form').on('submit',function(event){
        event.preventDefault();
        $.ajax({
            url:"include/student/check_student_login.php",
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            beforeSend:function(){
                $('#student_login').val('Validation ...')
                $('#student_login').attr('disabled','disabled')
            },success:function(data)
            {
                if(data.success){
                    location.href="index.php"
                }
                if(data.error){
                    $('#student_login').val('Connexion')
                    $('#student_login').attr('disabled',false)
                    if(data.error_student_emailid != ''){
                        $('#error_student_emailid').text(data.error_student_emailid)
                    }else{
                        $('#error_student_emailid').text('')
                    }
                    if(data.error_student_password !=''){
                        $('#error_student_password').text(data.error_student_password)
                    }else{
                        $('#error_student_password').text('')
                    }
                }
            }
        })
    })   
})