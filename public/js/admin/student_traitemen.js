$(document).ready(function(){
    $('#bar').click(function(){
             $(this).toggleClass('open');
            $('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled' );
     });
 var dataTable = $('#student_table').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"../include/admin/student_action.php",
   type:"POST",
   data:{action:'fetch'}
  },
  "columnDefs":[
   {
    "targets":[4, 5],
    "orderable":false,
   },
  ],
 });

  $('#student_dob').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,  
        container: '#formModal modal-body'
    });

  function clear_field()
  {
    $('#student_form')[0].reset();
    $('#error_student_name').text('');

    $('#error_student_dob').text('');
    $('#error_student_grade_id').text('');
    $('#error_student_addresse').text('')
  }

  $('#add_button').click(function(){
    $('#modal_title').text("Add Student");
    $('#button_action').val('Add');
    $('#action').val('Add');
    $('#formModal').modal('show');
    clear_field();
  });

  

  $('#student_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"../include/admin/student_action.php",
      method:"POST",
      data:$(this).serialize(),
      dataType:"json",
      beforeSend:function()
      {
        $('#button_action').attr('disabled', 'disabled');
        $('#button_action').val('Validate...');
      },
      success:function(data){
        $('#button_action').attr('disabled', false);
        $('#button_action').val($('#action').val());
        if(data.success)
        {
          $('#message_operation').html('<div class="alert alert-success">'+data.success+'</div>');
          clear_field();
          $('#formModal').modal('hide');
          dataTable.ajax.reload();
        }
        if(data.error)
        { 
          if(data.error_student_name != '')
          {
            $('#error_student_name').text(data.error_student_name);
          }
          else
          {
            $('#error_student_name').text('');
          }

          if(data.error_student_dob != '')
          {
            $('#error_student_dob').text(data.error_student_dob);
          }
          else
          {
            $('#error_student_dob').text('');
          }
          if(data.error_student_grade_id != '')
          {
            $('#error_student_grade_id').text(data.error_student_grade_id);
          }
          else
          {
            $('#error_student_grade_id').text('');
          }
          if(data.error_fac != '')
          {
            $('#error_student_fac').text(data.error_fac);
          }
          else
          {
            $('#error_student_fac').text('');
          }
          if(data.error_dep != '')
          {
            $('#error_student_dep_id').text(data.error_dep);
          }
          else
          {
            $('#error_student_dep_id').text('');
          }
        }
      }
    });
  });

  var student_id = '';

  $(document).on('click', '.edit_student', function(){
    student_id = $(this).attr('id');
    clear_field();
    $.ajax({
      url:"../include/admin/student_action.php",
      method:"POST",
      data:{action:'edit_fetch', student_id:student_id},
      dataType:"json",
      success:function(data)
      {
        $('#student_name').val(data.student_name);
        $('#student_addresse').val(data.student_mail)
        $('#student_dob').val(data.student_dob);
        //$('#teacher_qualification').val(data.teacher_qualification);
        //$('#teacher_doj').val(data.teacher_doj);
        $('#student_grade_id').val(data.student_grade_id);
        $('#student_fac_id').val(data.student_fac);
        $('#student_dep_id').val(data.student_dep);
        $('#student_id').val(data.student_id);
        $('#modal_title').text("Edit Student");
        $('#button_action').val('Edit');
        $('#action').val('Edit');
        $('#formModal').modal('show');
      }
    });
  });

  $(document).on('click', '.delete_student', function(){
    student_id = $(this).attr('id');
    $('#deleteModal').modal('show');
  });

  $('#ok_button').click(function(){
    $.ajax({
      url:"../include/admin/student_action.php",
      method:"POST",
      data:{student_id:student_id, action:'delete'},
      success:function(data)
      {
        $('#message_operation').html('<div class="alert alert-success">'+data+'</div>');
        $('#deleteModal').modal('hide');
        dataTable.ajax.reload();
      }
    });
  });

});