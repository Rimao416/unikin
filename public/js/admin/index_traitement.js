$(document).ready(function(){
    $('#bar').click(function(){
$(this).toggleClass('open');
$('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled' );
});
    var dataTable=$('#student_table').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url:"../include/admin/attendance_action.php",
            type:"POST",
            data:{action:'index_fetch'}
        }
    })
    $('.input-daterange').datepicker({
        todayBtn:"linked",
        format:'yyyy-mm-dd',
        autoclose:true
    });
    $(document).on('click','.report_button',function(){
        var student_id=$(this).data('student_id');
        $('#student_id').val(student_id);
        $('#formModal').modal('show')

    })
    $('#create_report').click(function(){
        var student_id=$('#student_id').val();
        var from_date=$('#from_date').val();
        var to_date=$('#to_date').val();
        var error=0;
        var action=$('#report_action').val();
        if(from_date==''){
            $('#error_from_date').text('From Date is required')
            error++;
        }else{
            $('#error_from_date').text('')
        }
        if(to_date==''){
            $('#error_to_date').text('To Date Is required')
            error++;
        }else{
            $('#error_to_date').text('')
        }
        if(error==0){
            $('#from_date').val('')
            $('#to_date').val('')
            $('#formModal').modal('hide')
            if(action=='pdf_report'){
            window.open("report.php?action=student_report&student_id="+student_id+"&from_date="+from_date+"&to_date="+to_date);
        }
     if(action=='chart_report'){
             
            window.open("chart.php?action=student_chart&student_id="+student_id+"&from_date="+from_date+"&to_date="+to_date);
        }
        }
    })
})

