//CHANGEMENT DU MOT DE PASSE DE L'UTILISATEUR
$(document).on('click','#change_password',function(){
    $('.login__teacher').
    html('<div class="cross" style="background-color:white;">'+
    '<h4 style="position:relative;left:95%;cursor:pointer;border-radius:150px;" id="comeBack">X</h4>'+
        '<form action="#" id="teacher_ajax" class="teacher_ajax password_net"><div class="user-details">'+
         '<div class="input-box"><span class="details">Mot de Passe Actuel</span>'+
         '<input type="text" id="password" name="password"><span id="password_error"></span></div>'+
         '<div class="input-box"><span class="details">Nouveau Mot de Passe</span>'+
         '<input type="text" id="new_pass" name="new_pass"><span id="new_error"></span></div>'+
         '<div class="input-box"><span class="details">Confirmez le nouveau mot de passe</span><input type="text" id="confirm_pass" name="confirm_pass"><span id="confirm_error"></span>'+
         '</div><div class="input-box"></div>'+
         '<div class="input-box">'+
         '</div>'+
         '<input type="hidden" id="action" name="action" value="del_modification">'+
         '<div class="button"><center> <button class="btn btn-success" id="Modifier" type="submit">Confirmer</button> </center></div></form></div>')
         $(document).on('submit','.password_net',function(event){
             event.preventDefault()
             error=false
             var password=$('#password').val();
             var new_pass=$('#new_pass').val();
             var confirm_pass=$('#confirm_pass').val();
             if(($.trim(password)=='')){
                $('#password_error').html('<span class="text-danger">Le champ ne peut être vide</span>');
                error=true
                  }
            if(($.trim(new_pass)=='')){
                $('#new_error').html('<span class="text-danger">Le champ ne peut être vide</span>');
                error=true
                  }
              if(($.trim(confirm_pass)=='')){
                  error=true
                $('#new_error').html('<span class="text-danger">Le champ ne peut être vide</span>');
                  }
            if(error==false){
                $.ajax({
                    url:"profile_pro.php",
                    method:"post",
                    data:$(this).serialize(),
                    dataType:"json",
                    success:function(data){
                        if(data.success){
                            location.reload()
                        }
                        else if(data.error){
                            if(data.error_identique!=''){
                                $('#password_error').html('<span class="text-danger">'+data.error_identique+'</span>');
                            }else{
                                $('#password_error').html('<span class="text-danger"></span>');
                            }
                            if(data.error_confirm!=''){
                                $('#new_error').html('<span class="text-danger">'+data.error_confirm+'</span>');
                                $('#confirm_error').html('<span class="text-danger">'+data.error_confirm+'</span>');
                            }else{
                                $('#new_error').html('<span class="text-danger"></span>');
                                $('#confirm_error').html('<span class="text-danger"></span>');
                            }
                        }


                    }
                })
                $(document).on('click','#comeBack',function(){
                    location.reload()
                  })
            }
         })
})