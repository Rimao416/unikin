$(function(){
    $('#bar').click(function(){
     $(this).toggleClass('open');
     $('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled' );
     });  

    toastr["info"]("Cher Administrateur, avant d'apporter quelconque modification à une matière, cela pourrait causer certains dysfonctionnement au sein du programme", "Information ")

     toastr.options = {
       "closeButton": true,
       "debug": false,
       "newestOnTop": false,
       "progressBar": true,
       "positionClass": "toast-bottom-right",
       "preventDuplicates": false,
       "onclick": null,
       "showDuration": "300",
       "hideDuration": "1000",
       "timeOut": "5000",
       "extendedTimeOut": "1000",
       "showEasing": "swing",
       "hideEasing": "linear",
       "showMethod": "fadeIn",
       "hideMethod": "fadeOut"
     }
    var dataTable=$('#matiere_table').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
                url:"../include/admin/matiere_action.php",
                type:"POST",
                data:{action:'fetch'}
            },
            "columnDefs":[
                {
                    "targets":[0, 1 ,2],
                    "orderable":false,
                },
            ],
    });
    $('#add_button').click(function(){
    $('#modal-title').text("Ajouter une matière");
    $('#button_action').val('Ajouter');
    $('#action').val('Add');
    $('#formModal').modal('show');
    clear_field();
  });
  function clear_field()
  {
    $('#matiere_form')[0].reset();
  }
  $('#matiere_form').on('submit',function(event){
        event.preventDefault();
        $.ajax({
            url:"../include/admin/matiere_action.php",
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            beforeSend:function(){
                $('#button_action').attr('disabled','disabled');
                $('#button_action').val('Validate...');
            },
            success:function(data){
                $('#button_action').attr('disabled',false);
                $('#button_action').val($('#action').val());
                if(data.success){
                    $('#message_operation').html('<div class="alert alert-success">'+data.success+'</div>')
                    $('#formModal').modal('hide')
                    clear_field()
                    dataTable.ajax.reload()
                }
                if(data.error){
                    if(data.error_matiere_name !=''){
                        $('#error_matiere_name').text(data.error_matiere_name);
                    }else{
                        $('#error_matiere_name').text('');
                    }
                    if(data.error_grade_id !=''){
                        $('#error_teacher').text(data.error_grade_id);
                    }else{
                        $('#error_teacher').text('')
                    }
                    if(data.error_teacher_id !=''){
                        $('#error_id').text(data.error_teacher_id);
                    }else{
                        $('#error_id').text('')
                    }
                }
            }
        })  
    })
    var matiere_id='';
    $(document).on('click','.edit_matiere',function(){
        matiere_id = $(this).attr('id');
        
        clear_field();
        $.ajax({
        url:"../include/admin/matiere_action.php",
        method:"POST",
        data:{action:'edit_fetch',matiere_id:matiere_id},
        dataType:"JSON",
        success:function(data)
        {
            $('#matiere_name').val(data.matiere_name);
            $('#matiere_id').val(data.matiere_id);
            $('#teacher_grade_id').val(data.prof)
            $('#grade_id').val(data.grade)
            $('#modal-title').text("Edit Grade");
            $('#button_action').val('Edit');
            $('#action').val('Edit');
            $('#formModal').modal('show');
        }
            })

        })
    $(document).on('click','.delete_matiere',function(){
        matiere_id=$(this).attr('id');
        $('#deleteModal').modal('show');
    })
    $('#ok_button').click(function(){
        $.ajax({
            url:"../include/admin/matiere_action.php",
            method:"POST",
            data:{matiere_id,matiere_id,action:'delete'},
            success:function(data)
            {
                $('#message_operation').html('<div class="alert alert-success">'+data+'</div>');
                $('#deleteModal').modal('hide')
                dataTable.ajax.reload()
            }
        })
    })
 })