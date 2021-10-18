$(function(){
    $('#teacher_account_form').on('submit',function(event){
        event.preventDefault()
        var recovery=$('#teacher_recovery').val()
        if(!recovery.trim()){
            $('#error_teacher_recovery').text("Entrez une addresse mail valide")
        }else{
            if((isEmail(recovery)==true)){
                $.ajax({
                    url:"recovery_action.php",
                    method:"post",
                    data:$(this).serialize(),
                    /*dataType:"json",*/
                    success:function(data){
                        var response=parseInt(data)
                        //alert(data)
                        if(response==0){
                            $('#error_teacher_recovery').attr('class',"text-danger")
                            $('#error_teacher_recovery').text("Addresse Mail non trouvée, réessayer ou contactez l'administration")
                        }else{
                            $('#error_teacher_recovery').attr('class',"text-success")
                            $('#error_teacher_recovery').text("Veuillez votre couriel, une addresse contenant vos nouvelles coordonnées vient de vous être envoyée")                                
                            console.log(recovery)
                            $.ajax({
                                url:"recovery_action.php",
                                method:"POST",
                                data:{action:'send_mail',addresse:recovery},
                                success:function(data){
                                    console.log("DEVELOPPER")
                                }
                            })
                        }
                    }
                })
            }else{
                $('#error_teacher_recovery').attr('class',"text-danger")
                $('#error_teacher_recovery').text("Entrez une addresse mail valide")
            }
        }
    })
})
