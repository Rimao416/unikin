$(document).ready(function(){
    $('#bar').click(function(){
      $(this).toggleClass('open');
      $('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled' );
  });
     var nombre=$('#Nombre').text();
   var dataTable = $('#attendance_table').DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "lengthMenu": [nombre,nombre*2,nombre*3,nombre*4,nombre*5,nombre*6,nombre*7],
    "ajax":{
     url:"../include/teacher/attendance_action.php",
     type:"POST",
     data:{action:'fetch'}
    }
   });
  
    $('#attendance_date').datepicker({
          format: "yyyy-mm-dd",
          autoclose: true
      });
  
    function clear_field()
    {
      $('#attendance_form')[0].reset();
      //$('#error_student_grade_id').text('');
      $('#error_attendance_date').text('');
    }
  
    $('#add_button').click(function(){
      $('#modal_title').text("PRESENCE");
        $('#button_action').val('Confirmer');
      $('#action').val('Add');
      $('#formModal').modal('show');
      clear_field();
    });
    $('#attendance_form').on('submit',function(event){
        event.preventDefault();
        console.log($('#attendance_date'))
        var date=$('#attendance_date');
        console.log(date.val())
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' +dd ;
        if(date.val()!=today)
        {
          $('#error_attendance_date').text('Entrez la date actuelle')
        }else{
        $.ajax({
            url:"../include/teacher/attendance_action.php",
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            beforeSend:function(){
                $('#button_action').val('Validate...');
                $('#button_action').attr('disabled','disabled');
            },
            success:function(data){
                $('#button_action').attr('disabled',false);
                $('#button_action').val($('#action').val())
                if(data.success)
                {
                  $('#message_operation').html('<div class="alert alert-success">'+data.success+'</div>');
                    
                    $('#formModal').modal('hide')
                    dataTable.ajax.reload();
                }
  
                if(data.error){
                    if(data.error_attendance_date !=''){
                        $('#error_attendance_date').text(data.error_attendance_date);
                    }
                    else{
                        $('#error_attendance_date').text('');
                    }
                }
            }
        })
      }
    })
    $('.input-daterange').datepicker({
      todayBtn:"linked",
      format:"yyyy-mm-dd",
      autoclose:true
      //container:'#formModal moal-body'
    });
    $(document).on('click','#report_button',function(){
        $('#reportModal').modal('show') 
    })
    $('#create_report').click(function(){
        var from_date=$('#from_date').val();
        var to_date=$('#to_date').val();
        var error=0;
        if(from_date ==''){
          $('#error_from_date').text('La date du début est réquise')
          error++;
  
        }else{
            $('#error_from_date').text('');
        }
        if(to_date ==''){
          $('#error_to_date').text('La Date de Fin est réquise')
          error++;
        }else{
          $('#error_to_date').text('')
        }
        if(error==0){
            $('#from_date').val('');
            $('#to_date').val('');
            $('#formModal').modal('hide')
            window.open("report.php?action=attendance_report&from_date="+from_date+"&to_date="+to_date)
        }
    })
  //  $('#attendance_table_length label').text('salut')
  /*$('Window').on('load',function(){
    alert('oui oui')
  })  
  $("Show").replaceAll('oui oui')
  */
  });