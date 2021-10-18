$(function(){
    $('#bar').click(function(){
     $(this).toggleClass('open');
     $('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled' );
     });
    var dataTable=$('#grade_table').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
                url:"../include/admin/grade_action.php",
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
    $('#modal-title').text("Ajouter une classe");
    $('#button_action').val('Add');
    $('#action').val('Add');
    $('#formModal').modal('show');
    clear_field();
  });
  function clear_field()
  {
    $('#grade_form')[0].reset();
    $('#error_grade_name').text('');
  }
  $('#grade_form').on('submit',function(event){
        event.preventDefault();
        $.ajax({
            url:"../include/admin/grade_action.php",
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
                    if(data.error_grade_name !=''){
                        $('#error_grade_name').text(data.error_grade_name);
                    }else{
                        $('#error_grade_name').text('');
                    }
                }
            }
        })
        
    })
    var grade_id='';
    $(document).on('click','.edit_grade',function(){
        grade_id = $(this).attr('id');
        
        clear_field();
        $.ajax({
        url:"../include/admin/grade_action.php",
        method:"POST",
        data:{action:'edit_fetch',grade_id:grade_id},
        dataType:"JSON",
        success:function(data)
        {
            $('#grade_name').val(data.grade_name);
            $('#grade_id').val(data.grade_id);
            $('#modal-title').text("Edit Grade");
            $('#button_action').val('Edit');
            $('#action').val('Edit');
            $('#formModal').modal('show');
        }
            })

        })
    $(document).on('click','.delete_grade',function(){
        grade_id=$(this).attr('id');
        $('#deleteModal').modal('show');
    })
    $('#ok_button').click(function(){
        $.ajax({
            url:"../include/admin/grade_action.php",
            method:"POST",
            data:{grade_id,grade_id,action:'delete'},
            success:function(data)
            {
                $('#message_operation').html('<div class="alert alert-success">'+data+'</div>');
                $('#deleteModal').modal('hide')
                dataTable.ajax.reload()
            }
        })
    })


 })