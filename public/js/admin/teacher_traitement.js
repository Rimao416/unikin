
$(document).ready(function(){
  
    toastr["info"]("Cher Administrateur, la suppression d'un professeur, incluera également la suppression de tout son dépôt des cours", "Information ")
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

    $('#bar').click(function(){
         $(this).toggleClass('open');
        $('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled' );
 });
 var dataTable = $('#teacher_table').DataTable({
"processing":true,
"serverSide":true,
"order":[],
"ajax":{
url:"../include/admin/teacher_action.php",
type:"POST",
data:{action:'fetch'}
},
"columnDefs":[
{
"targets":[0, 4, 5],
"orderable":false,
},
],
});

$('#teacher_doj').datepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
    container: '#formModal modal-body'
});

function clear_field()
{
$('#teacher_form')[0].reset();
$('#error_teacher_name').text('');
$('#error_teacher_address').text('');
$('#error_teacher_emailid').text('');

$('#error_teacher_qualification').text('');
$('#error_teacher_doj').text('');
$('#error_teacher_image').text('');

}

$('#add_button').click(function(){
$('#modal_title').text("Zone d'ajout");
$('#button_action').val('Ajouter');
$('#action').val('Add');
$('#formModal').modal('show');
clear_field();
});

$('#teacher_form').on('submit', function(event){
event.preventDefault();
$.ajax({
  url:"../include/admin/teacher_action.php",
  method:"POST",
  data:new FormData(this),
  dataType:"json",
  contentType:false,
  processData:false,
  beforeSend:function()
  {        
    $('#button_action').val('Validate...');
    $('#button_action').attr('disabled', 'disabled');
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
      if(data.error_teacher_name != '')
      {
        $('#error_teacher_name').text(data.error_teacher_name);
      }
      else
      {
        $('#error_teacher_name').text('');
      }
      if(data.error_teacher_address != '')
      {
        $('#error_teacher_address').text(data.error_teacher_address);
      }
      else
      {
        $('#error_teacher_address').text('');
      }
      if(data.error_teacher_emailid != '')
      {
        $('#error_teacher_emailid').text(data.error_teacher_emailid);
      }
      else
      {
        $('#error_teacher_emailid').text('');
      }
      if(data.error_teacher_password != '')
      {
        $('#error_teacher_password').text(data.error_teacher_password);
      }
      else
      {
        $('#error_teacher_password').text('');
      }
      if(data.error_teacher_qualification != '')
      {
        $('#error_teacher_qualification').text(data.error_teacher_qualification);
      }
      else
      {
        $('#error_teacher_qualification').text('');
      }
      if(data.error_teacher_doj != '')
      {
        $('#error_teacher_doj').text(data.error_teacher_doj);
      }
      else
      {
        $('#error_teacher_doj').text('');
      }
      if(data.error_teacher_image != '')
      {
        $('#error_teacher_image').text(data.error_teacher_image);
      }
      else
      {
        $('#error_teacher_image').text('');
      }
    }
  }
});
});

var teacher_id = '';

$(document).on('click', '.view_teacher', function(){
teacher_id = $(this).attr('id');
$.ajax({
  url:"../include/admin/teacher_action.php",
  method:"POST",
  data:{action:'single_fetch', teacher_id:teacher_id},
  success:function(data)
  {
    $('#viewModal').modal('show');
    $('#teacher_details').html(data);
  }
});
});

$(document).on('click', '.edit_teacher', function(){
teacher_id = $(this).attr('id');
clear_field();
$.ajax({
  url:"../include/admin/teacher_action.php",
  method:"POST",
  data:{action:'edit_fetch', teacher_id:teacher_id},
  dataType:"json",
  success:function(data)
  {
    $('#teacher_name').val(data.teacher_name);
    $('#teacher_address').val(data.teacher_address);

    $('#teacher_qualification').val(data.teacher_qualification);
    $('#teacher_doj').val(data.teacher_doj);
    $('#error_teacher_image').html('<img src="teacher_image/'+data.teacher_image+'" class="img-thumbnail" width="50" />');
    $('#hidden_teacher_image').val(data.teacher_image);
    $('#teacher_id').val(data.teacher_id);
    $('#modal_title').text("Edit Teacher");
    $('#button_action').val('Edit');
    $('#action').val('Edit');
    $('#formModal').modal('show');
  }
});
});

$(document).on('click', '.delete_teacher', function(){
teacher_id = $(this).attr('id');
$('#deleteModal').modal('show');
});

$('#ok_button').click(function(){
$.ajax({
  url:"../include/admin/teacher_action.php",
  method:"POST",
  data:{teacher_id:teacher_id, action:'delete'},
  success:function(data)
  {
    $('#message_operation').html('<div class="alert alert-success">'+data+'</div>');
    $('#deleteModal').modal('hide');
    dataTable.ajax.reload();
  }
});
});
})