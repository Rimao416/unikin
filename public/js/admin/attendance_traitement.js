$(function(){
    $('#bar').click(function(){
  $(this).toggleClass('open');
  $('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled' );
});
      var dataTable=$('#attendance_table').DataTable({
          "processing":true,
          "serverSide":true,
          "order":[],
          "ajax":{
              url:"../include/admin/attendance_action.php",
              type:"POST",
              data:{action:'fetch'}
          }
      })
      $('.input-daterange').datepicker({
          todayBtn:"linked",
          format:"yyyy-mm-dd",
          autoclose:true
      })
      $(document).on('click','#report_button',function(){
          $('#reportModal').modal('show')
      })
      $('#create_report').click(function(){
          var grade_id=$('#grade_id').val()
          var from_date=$('#from_date').val()
          var to_date=$('#to_date').val()
          var error=0;
          if(grade_id==''){
              $('#error_grade_id').text('Grade is required')
              error++;
          }
          else{
              $('#error_grade_id').text('');
          }
          if(from_date ==''){
              $('#error_from_date').text('From Date is required');
              error++;
          }else{
              $('#error_from_date').text('')
          }
          if(to_date==''){
              $('#error_to_date').text("To date is required")
              error++;
          }
          else{
              $('#error_to_date').text('');
          }
          if(error==0){
              $('#from_date').val('')
              $('#to_date').val('')
              $('#formModal').modal('hide')
              window.open("report.php?action=attendance_report&grade_id="+grade_id+"&from_date="+from_date+"&to_date="+to_date)
          }
      })
      $('#chart_button').click(function(){
        $('#chart_grade_id').val('')
        $('#attendance_date').val('')
        $('#chartModal').modal('show')
      })
      $('#create_chart').click(function(){
        var grade_id=$('#chart_grade_id').val();
        var attendance_date=$('#attendance_date').val()
        var error=0;
        if(grade_id=='')
        {
          $('#error_chart_grade_id').text('Grade is required')
          error++;           
        }else{
            $('#error_chart_grade_id').text('')

        }
        if(attendace_date==''){
          $('#error_attendance_date').text('Date is Required')
          error++;
        }else{
          $('#error_attendance_date').text('')
        }
        if(error==0){
          $('#attendance_date').val()
          $('#chart_grade_id').val('')
          $('#chartModal').modal('show')
          window.open("chart1.php?action=attendance_report&grade_id="+grade_id+"&date="+attendance_date);
        }
      })
  })
