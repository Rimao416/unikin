
(function ($) {
    "use strict";
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
    var input = $('.validate-input .input100');
    $('.validate-form').on('submit',function(event){ 
        event.preventDefault()
        var check = true;
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }
        if(check==true){
            $.ajax({
                url:"../include/admin/check_admin_login.php",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                beforeSend:function(){
                    $('#admin_login').val('Validate...');
                    $("#admin_login").attr('disabled','disabled');
                  
                },
                success:function(data){
                    if(data.success){
                        location.href="index.php";

                    }
                    if(data.error){

                        $('#admin_login').val('Login');
                        $('#admin_login').attr('disabled',false);
                        if(data.error_admin_user_name !=''){
                            showValidate(input[0])

                        }else{
                            $('#error_admin_user_name').text('ERREUR')
                        }
                        if(data.error_admin_password!=''){
                            showValidate(input[1])
                        }else{
                            $('#error_admin_password').text('ERREUR')
                        }
                    }
                }
            })
        }
        return check
    });
    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }


    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
})(jQuery);