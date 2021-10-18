<?php
    require_once 'dompdf2/autoload.inc.php';        
    use Dompdf\Dompdf;      
            
    $dompdf=new Dompdf();
    $dompdf2=new Dompdf();
/*
  */     
  $output='';
 if(isset($_GET["action"])){
        include('../include/database_connection.php');
           

        session_start();
        if($_GET["action"]=="attendance_report")
        {
            if(isset($_GET['from_date'],$_GET["to_date"]))
    
            {

     
                $query="SELECT attendance_date FROM tbl_attendance 
                WHERE matiere_id ='".$_SESSION["matiere"]."'
                AND (attendance_date BETWEEN '".$_GET["from_date"]."' 
                AND '".$_GET["to_date"]."')
                GROUP BY attendance_date ORDER BY attendance_date ASC";
                $statement=$connect->prepare($query);
                $statement->execute();
                $result=$statement->fetchAll();
                $output .= '
                 <style>
                 @page { margin: 30px;
                    font-family:Roboto;
                }
                h3{
                    text-align:left;
                    font-size:20px;
                    text-decoration:underline;
                }
                
                td{
                    text-align:center;
                    font-family:roboto;
                    font-size:18px;
                }
                td.date{
                    text-align:left;
                    margin-left:15%;
                }
                 
                 </style>
                 <p>&nbsp;</p>
                 <h3 align="center">FICHE DE PRESENCE</h3><br />';
                foreach($result as $row)
                {
                 $output .= '
                 <table width="100%" border="0" cellpadding="5" cellspacing="0">
                        <tr>
                         <td class="date"><b>Date - '.$row["attendance_date"].'</b></td>
                        </tr>
                        <tr>
                         <td>
                          <table width="100%" border="1" cellpadding="5" cellspacing="0">
                           <tr>
                            <td><b>Etudiant</b></td>
                            <td><b>N°</b></td>
                            <td><b>Niveau</b></td>
                            <td><b>Status</b></td>
                           </tr>
                    ';
                    $sub_query="SELECT * FROM tbl_attendance
                    INNER JOIN tbl_student ON tbl_student.student_id=tbl_attendance.student_id

                    INNER JOIN tbl_grade ON tbl_grade.grade_id = tbl_student.student_grade_id
                    WHERE matiere_id ='".$_SESSION["matiere"]."' AND attendance_date= '".$row["attendance_date"]."'                    
                    ";
                 $statement = $connect->prepare($sub_query);
                 $statement->execute();
                 $sub_result = $statement->fetchAll();
                 foreach($sub_result as $sub_row)
                 {
                  $output .= '
                  <tr>
                   <td>'.$sub_row["student_name"].'</td>
                   <td>'.$sub_row["student_roll_number"].'</td>
                   <td>'.$sub_row["grade_name"].'</td>
                   <td>'.$sub_row["attendance_status"].'</td>
                  </tr>
                  ';
                 }
           
                 $output .= '</table>
                 </td>
                 </tr>
                 </table><br/>';
                        
     
                         
                    }
                    $output .='Par le Professeur  '.get_all($connect,'tbl_teacher','teacher_id',$_SESSION['teacher_id'],'teacher_name').' Fait à KIN le '.date('d-M-Y') ;
                    $file_name="Attendance_Report.pdf";
                    $dompdf->loadHtml($output);
                    $dompdf->setPaper('A4','portrait');
                    $dompdf->render();
                    $dompdf->stream($file_name,array("Attachment"=>0));         
                    
                }
    
        }
        if($_GET['action']=="student_report"){
            if(isset($_GET["student_id"],$_GET["from_date"],$_GET["to_date"]))
            {
                $query="SELECT * FROM tbl_student 
                INNER JOIN departement ON tbl_student.student_dep = departement.id
                WHERE tbl_student.student_id='".$_GET["student_id"]."'";
                $statement=$connect->prepare($query);
                $statement->execute();
                $result=$statement->fetchAll();
                foreach($result as $row){
                    $output .= '
                    <style>
                    @page { margin: 20px; }
                    
                    </style>
                    <p>&nbsp;</p>
                    <h3 align="center">FICHE DES PRESENCES</h3><br /><br />
                    <table width="100%" border="0" cellpadding="5" cellspacing="0">
                           <tr>
                               <td width="25%"><b>Nom Etudiant</b></td>
                               <td width="75%">'.$row["student_name"].'</td>
                           </tr>
                           <tr>
                               <td width="25%"><b>Numéro</b></td>
                               <td width="75%">'.$row["student_roll_number"].'</td>
                           </tr>
                           <tr>
                               <td width="25%"><b>Departement</b></td>
                               <td width="75%">'.get_departement_user($connect,$_GET['student_id'],'tbl_student','departement','tbl_student.student_dep','departement.id','tbl_student.student_id','nom_dep').'</td>
                           </tr>
                           <tr>
                               <td width="25%"><b>Faculte</b></td>
                               <td width="75%">'.get_departement_user($connect,$_GET['student_id'],'tbl_student','faculte','tbl_student.student_fac','faculte.id','tbl_student.student_id','section_name').'</td>
                           </tr>
                           <tr>
                               <td width="25%"><b>Niveau</b></td>
                               <td width="75%">'.get_departement_user($connect,$_GET['student_id'],'tbl_student','tbl_grade','tbl_student.student_grade_id','tbl_grade.grade_id','tbl_student.student_id','grade_name').'</td>
                           </tr>
                           <tr>
                            <td colspan="2" height="5">
                             <h3 align="center">Details</h3>
                            </td>
                           </tr>
                           <tr>
                            <td colspan="2">
                             <table width="100%" border="1" cellpadding="5" cellspacing="0">
                              <tr>
                               <td><b>Date de Presence</b></td>
                               <td><b>Status</b></td>
                               <td><b>Cours</b></td>
                              </tr>
                    ';
                    $sub_query="SELECT * FROM tbl_attendance 
                    INNER JOIN tbl_matiere ON tbl_matiere.id_matiere=tbl_attendance.matiere_id
                    WHERE student_id='".$_GET["student_id"]."'
                    AND (attendance_date BETWEEN '".$_GET["from_date"]."' AND '".$_GET["to_date"]."')
                    ORDER BY attendance_date ASC";
                    $statement=$connect->prepare($sub_query);
                    $statement->execute();
                    $sub_result=$statement->fetchAll();
                    foreach($sub_result as $sub_row){
                    $output .='
                        <tr>
                        <td>'.$sub_row["attendance_date"].'</td>
                        <td>'.$sub_row["attendance_status"].'</td>
                        <td>'.ucfirst($sub_row["nom_matiere"]).'</td>
                       </tr>
                      ';
                    }
                    $output .= '
                    </table>
                   </td>
                   </tr>
                  </table>
                  ';
                  $file_name = 'Attendance Report.pdf';
                  $dompdf2->loadHtml($output);
                  $dompdf2->render();
                  $dompdf2->stream($file_name, array("Attachment" => false));
                  exit(0);
                }
            }
        }
    }

       

?>
