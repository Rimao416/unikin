$(function(){
    $('#student_account_form').on('submit',function(event){
        event.preventDefault()
        var recovery=$('#student_recovery').val()
        if(!recovery.trim()){
            $('#error_student_recovery').text("Entrez une addresse mail valide")
        }else{
            if((isEmail(recovery)==true)){
                $.ajax({
                    url:"include/student/forgot_action.php",
                    method:"post",
                    data:$(this).serialize(),
                    /*dataType:"json",*/
                    success:function(data){
                        var response=parseInt(data)
                        //alert(data)
                        if(response==0){
                            $('#error_student_recovery').attr('class',"text-danger")
                            $('#error_student_recovery').text("Addresse Mail non trouvée, réessayer ou contactez l'administration")
                        }else{
                            $('#error_student_recovery').attr('class',"text-success")
                            $('#error_student_recovery').text("Veuillez votre couriel, une addresse contenant vos nouvelles coordonnées vient de vous être envoyée")                                
                            console.log(recovery)
                            $.ajax({
                                url:"include/student/forgot_action.php",
                                method:"POST",
                                data:{action:'send_mail',addresse:recovery},
                                success:function(data){
                                    $('#create_link').append("<a href='login.php' id='Connexion_login'>Me connecter</a>")
                                }
                            })
                        }
                    }
                })
            }else{
                $('#error_student_recovery').attr('class',"text-danger")
                $('#error_student_recovery').text("Entrez une addresse mail valide")
            }
        }
    })
})