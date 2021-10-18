$('#Index_Student_Custom').click(function(){
  $(".informations_teacher").css("display", "none");
  $('.teacher_course_profile_himself').css("display","none")
  var action='teach'
  $.ajax({
    url:"profile_pro.php",
    method:"post",
    data:{action:action},
    dataType:"json",
    success:function(data){
      $('.login__teacher').
   html('<div class="cross">'+
   '<div class="head__profile">'+
      '<div class="img__part">'+
      '<h4 style="position:relative;left:95%;cursor:pointer;border-radius:150px;" id="comeBack">X</h4>'+
          '<img id="prof_profile" src="../admin/images/1.jpg">'+
      '</div>'+
      '<div class="text_part">'+
          '<h3 id="prof_nname"></h3>'+
      '</div>'+
   '</div><pre></pre>'+
   '<div class="card__user_authentification">'+
     '<form action="#" id="teacher_ajax" class="teacher_ajax"><div class="user-details">'+
        '<div class="input-box"><span class="details">Nom</span>'+
        '<input type="text" id="teacher_name" name="teacher_name"><span id="username_error"></span></div>'+
        '<div class="input-box"><span class="details">Prenom</span>'+
        '<input type="text" id="teacher_prenom" name="teacher_prenom"><span id="prenom_error"></span></div>'+
        '<div class="input-box"><span class="details">Email</span><input type="text" id="teacher_mail" name="teacher_mail"><span id="mail_error"></span>'+
        '</div><div class="input-box"><span class="details">Addresse</span><input type="text" id="teacher_living" name="teacher_living"><span id="addresse_error"></span></div>'+
        '<div class="input-box">'+
        '</div>'+
        '<input type="hidden" id="action" name="action" value="prof_modification">'+
        '<div class="button"> <center> <button class="btn btn-success" id="Modifier" type="submit">Confirmer</button> </center> </div></form></div>'+
        '<a href="#" id="change_password">Changer mon Mot de Passe</a></div>')
       //ALL EXCEPT PASSWORD
       $('#prof_profile').attr('src','../admin/teacher_image/'+data.teacher_profile)
       $('#prof_nname').text(data.teacher_name+" "+data.teacher_prenom)
        $('#teacher_name').val(data.teacher_name)
        $('#teacher_prenom').val(data.teacher_prenom)
        $('#teacher_mail').val(data.teacher_addresse)
        $('#teacher_living').val(data.teacher_living)      
        $('#teacher_ajax').on('submit',function(event){
              event.preventDefault()
              var error=false
              var username=$('#teacher_name').val();
              var prenom=$('#teacher_prenom').val();
              var mail=$('#teacher_mail').val();
              var addresse=$('#teacher_living').val()
              if(($.trim(username)=='')){
                  $('#username_error').html('<span class="text-danger">Le champ ne peut être vide</span>');
                  error=true
                      }
              if(($.trim(prenom)=='')){
                  $('#prenom_error').html('<span class="text-danger">Le champ ne peut être vide</span>');
                  error=true
                    }
              if(($.trim(mail)=='')){
                  $('#mail_error').html('<span class="text-danger">Le champ ne peut être vide</span>');
                  error=true
                    }
                if(($.trim(addresse)=='')){
                    error=true
                    $('#addresse_error').html('<span class="text-danger">L\'Addresse ne peut être vide</span>')
                    }
                    if($.trim(mail)==''){
                    error=true
                      }
                      if(error==false){
                       $.ajax({
                            url:'profile_pro.php',
                            method:'post',
                            data:$(this).serialize(),
                            success:function(data){
                                location.reload()
                                }
                           })
                        }
                        })
                        $(document).on('click','#comeBack',function(){
                          location.reload()
                        })

    }
  })

        
})