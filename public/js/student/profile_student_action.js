$(function(){
    $('.slider').slick({
        autoplay:true,
        autoplaySpeed:3000,
        fade:true,
        speed:4500
    })
    $('.mon_slider').slick({
        autoplay:true,
        autoplaySpeed:5000,
        fade:true,
        pauseonscroll:true,
        arrows:false
    })
    $(document).on('click','.unique_card',function(){
        var id_teacher=$(this).data('courses_teacher')
        location.href="detailsCours.php?Cours_action="+id_teacher;
    })
    $('#annulation').click(function(){
        location.reload()
    })
    $('#Index_Student_Custom').click(function(){
        var action="getinfo"
                $(this).css('opacity','0')
        $.ajax({
            url:"include/student/profile_info.php",
            method:"post",
            data:{action:action},
            dataType:"json",
            success:function(data){
                $('.card__student').css('opacity','0.2')
                $('.student__information').css('opacity','0.2')
                $('.others__courses').css('opacity','0.2')
                $('.teacher__courses').css('opacity','0.2')
                $('.absence_courses').
                html("<form method='post' id='modifie_user'><div class='student_profile_info'><h2>Mon Profil</h2><div class='edit_profile'><h3>Modification</h3><hr style='width: 100%;'><div class='form-group'><label for=''>Nom</label><input type='text' id='Username' name='Username' class='form-control'>" 
                +"<div id='username_error'></div>"   
                +"</div><div class='form-group'><label for=''>Grade</label><input type='text' id='Grade' name='Grade' disabled  class='form-control'></div><div class='form-group'><label for=''>Numéro Unique</label><input type='text' id='Numero' name='Numero' disabled  class='form-control'>"
                +"</div><div class='form-group'><label for=''>Addresse  de Connexion</label><input type='text' id='Addresse' name='Addresse' class='form-control'></div>"    
                +"<div id='Addresse_error'></div>"
                +"<div class='form-group'><label for=''>Addresse</label><input type='text' id='Addresse_Con' name='Addresse_Con' class='form-control'></div>"
                +"<input type='hidden' id='action' name='action' value='modification'>"
                +"<center> <button class='btn btn-success' type='submit' style='font-family: Roboto;font-weight:800;'>Je Modifie</button> </center></div></div></form>"
                +"<button class='btn btn-danger' id='annulation'>J'Annule'</button>");
                
                $('#Username').val(data.student_name)
                $('#Grade').val(data.grade_name)
                $('#Addresse').val(data.student_addresse)
                $('#Addresse_Con').val(data.mail_student)
               
                $('#Numero').val(data.roll_number)
                $('#annulation').click(function(){
                    location.reload()
                })

                $('#modifie_user').on('submit',function(event){
                    event.preventDefault()
                    var error=false
                    var username=$('#Username').val();
                    var mail=$('#Addresse_Con').val();
                    var addresse=$('#Addresse').val()
                    if(($.trim(username)=='')){
                        $('#username_error').html('<span class="text-danger">Le champ ne peut être vide</span>');
                        error=true
                    }
                    if(($.trim(addresse)=='')){
                        error=true
                        $('#Addresse_error').html('<span class="text-danger">L\'Addresse ne peut être vide</span>')
                    }
                    if($.trim(mail)==''){
                        error=true
                    }
                    if(error==false){
                    $.ajax({
                        url:'profile_info.php',
                        method:'post',
                        data:$(this).serialize(),
                        success:function(data){
                            location.reload()
                            }
                       })
                    }
                    })
            }

        })
    })

})