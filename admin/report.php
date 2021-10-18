<?php
        require_once '../teacher/dompdf2/autoload.inc.php';        
        use Dompdf\Dompdf;      
    
        $dompdf=new Dompdf();
        $dompdf2=new Dompdf();
    
    if(isset($_GET["action"])){
        include('../include/database_connection.php');
         //AJOUT DE LA CLASSE POUR PDF
         session_start();
         $output='';
         if($_GET["action"]=='attendance_report'){
             if(isset($_GET["grade_id"],$_GET["from_date"],$_GET['to_date'])){
                 //
                 $query = "SELECT tbl_attendance.attendance_date FROM tbl_attendance 
                 INNER JOIN tbl_student 
                 ON tbl_student.student_id = tbl_attendance.student_id 
                 WHERE tbl_student.student_fac = '".$_GET["grade_id"]."' 
                 AND (tbl_attendance.attendance_date BETWEEN '".$_GET["from_date"]."' AND '".$_GET["to_date"]."')
                 GROUP BY tbl_attendance.attendance_date 
                 ORDER BY tbl_attendance.attendance_date ASC
                 ";
                 $statement = $connect->prepare($query);
                 $statement->execute();
                 $result = $statement->fetchAll();
                 $output .= '
                 <style>
                 @page { margin: 20px; }
                 
                 </style>
                 <p>&nbsp;</p>
                 <h3 align="center">Attendance Report</h3><br />';
                 foreach($result as $row)
   {
    $output .= '
    <table width="100%" border="0" cellpadding="5" cellspacing="0">
           <tr>
            <td><b>Date - '.$row["attendance_date"].'</b></td>
           </tr>
           <tr>
            <td>
             <table width="100%" border="1" cellpadding="5" cellspacing="0">
              <tr>  
               <td><b>Student Name</b></td>
               <td><b>Roll Number</b></td>
               <td><b>Faculté</b></td>
               <td><b>Attendance Status</b></td>
              </tr>
       ';
       $sub_query = "SELECT * FROM tbl_attendance
        INNER JOIN tbl_student ON tbl_student.student_id = tbl_attendance.student_id 
        INNER JOIN faculte 
       ON faculte.id = tbl_student.student_fac  
       WHERE tbl_student.student_fac = '".$_GET["grade_id"]."' 
        AND tbl_attendance.attendance_date = '".$row["attendance_date"]."'
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
            <td>'.$sub_row["section_name"].'</td>
            <td>'.$sub_row["attendance_status"].'</td>
            </tr>
            ';
        }
            $output .= 
            '</table>
            </td>
            </tr>
            </table><br />';
 
        }
             $file_name="Attendane Report.pdf";
             $dompdf->loadHtml($output);
            $dompdf->render();
            $dompdf->stream($file_name,array("Attachment"=>false));
            
             }

            }
            if($_GET["action"]=="student_report"){
                if(isset($_GET["student_id"],$_GET["from_date"],$_GET["to_date"]))
                {
                    $query = "SELECT * FROM tbl_student INNER JOIN departement
                    ON departement.id = tbl_student.student_dep WHERE tbl_student.student_id = '".$_GET["student_id"]."'";

                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row){
                        $output .= '
                        <style>
                        @page { margin: 20px; }
                        
                        </style>
                        <p>&nbsp;</p>
                        <h3 align="center">Rapport de Présence</h3><br /><br />
                        <table width="100%" border="0" cellpadding="5" cellspacing="0">
                            <tr>
                                <td width="25%"><b>Student Name</b></td>
                                <td width="75%">'.$row["student_name"].'</td>
                            </tr>
                            <tr>
                                <td width="25%"><b>Grade</b></td>
                                <td width="75%">'.$row["nom_dep"].'</td>
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
                               <td><b>Date</b></td>
                               <td><b>Status</b></td>
                               <td><b>Cours</b></td>
                              </tr>';
                             $sub_query = "
                              SELECT * FROM tbl_attendance 
                              INNER JOIN tbl_matiere ON tbl_matiere.id_matiere=tbl_attendance.matiere_id
                              WHERE student_id = '".$_GET["student_id"]."' 
                              AND (attendance_date BETWEEN '".$_GET["from_date"]."' AND '".$_GET["to_date"]."') 
                              ORDER BY attendance_date ASC
                              ";
                              $statement = $connect->prepare($sub_query);
                              $statement->execute();
                              $sub_result = $statement->fetchAll();
                              foreach($sub_result as $sub_row)
                              {
                               $output .= '
                                <tr>
                                 <td>'.$sub_row["attendance_date"].'</td>
                                 <td>'.$sub_row["attendance_status"].'</td>
                                 <td>'.$sub_row["nom_matiere"].'</td>
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
                            }
                        }
                    }

        }
?>