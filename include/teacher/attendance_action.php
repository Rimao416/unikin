<?php

//attendance_action.php
include('../database_connection.php');
session_start();
$output = '';
if(isset($_POST["action"]))
{
 if($_POST["action"] == 'fetch')
 {
  $query = "
  SELECT * FROM tbl_attendance 
  INNER JOIN tbl_student 
  ON tbl_student.student_id = tbl_attendance.student_id 
  INNER JOIN tbl_grade 
  ON tbl_grade.grade_id = tbl_student.student_grade_id 
  WHERE tbl_attendance.matiere_id = '".$_SESSION["matiere"]."' AND (";
  if(isset($_POST["search"]["value"]))
  {
   $query .= 'tbl_student.student_name LIKE "%'.$_POST["search"]["value"].'%" 
      OR tbl_student.student_roll_number LIKE "%'.$_POST["search"]["value"].'%" 
      OR tbl_attendance.attendance_status LIKE "%'.$_POST["search"]["value"].'%" 
      OR tbl_attendance.attendance_date LIKE "%'.$_POST["search"]["value"].'%") ';
  }
  if(isset($_POST["order"]))
  {
   $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
  }
  else
  {
   $query .= 'ORDER BY tbl_attendance.attendance_id DESC ';
  }
  if($_POST["length"] != -1)
  {
   $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
  }

  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  $data = array();
  $filtered_rows = $statement->rowCount();
  foreach($result as $row)
  {
   $sub_array = array();
   $status = '';
   if($row["attendance_status"] == 'Present')
   {
    $status = '<label class="badge badge-success" id="Presence">Present</label>';
   }
   if($row["attendance_status"] == 'Absent')
   {
    $status = '<label class="badge badge-danger" id="Absence">Absent</label>';
   }
   
   $sub_array[] = $row["student_name"];
   $sub_array[] = $row["student_roll_number"];
   $sub_array[] = $row["grade_name"];
   $sub_array[] = $status;
   $sub_array[] = $row["attendance_date"];
   $data[] = $sub_array;
  }

  $output = array(
   "draw"    => intval($_POST["draw"]),
   "recordsTotal"  =>  $filtered_rows,
   "recordsFiltered" => get_total_records($connect, 'tbl_attendance'),
   "data"    => $data
  );
  echo json_encode($output);
 }
 if($_POST["action"] == "Add")
 {
   $information='';
  $attendance_date = '';
  $error_attendance_date = '';
  $error = 0;
  if(empty($_POST["attendance_date"]))
  {
   $error_attendance_date = 'La Date est requise';
   $error++;
  }
  else
  {
   $attendance_date = $_POST["attendance_date"];
  }
  if($error > 0)
  {
   $output = array(
    'error'       => true,
    'error_attendance_date'   => $error_attendance_date
   );
  }
  else
  {
   $student_id = $_POST["student_id"];
   $query = '
   SELECT attendance_date FROM tbl_attendance 
   WHERE teacher_id = "'.$_SESSION["teacher_id"].'" 
   AND attendance_date = "'.$attendance_date.'"
   ';
   $statement = $connect->prepare($query);
   $statement->execute();
   if($statement->rowCount() > 0)
   {
    $information .='   Une liste à cette date à déjà été faite';
   }

    for($count = 0; $count < count($student_id); $count++)
    {
     $data = array(
      ':student_id'   => $student_id[$count],
      ':attendance_status' => $_POST["attendance_status".$student_id[$count].""],
      ':attendance_date'  => $attendance_date,
      ':teacher_id'   => $_SESSION["teacher_id"],
      ':matiere'=>$_SESSION['matiere']
     );

     $query = "
     INSERT INTO tbl_attendance 
     (student_id, attendance_status, attendance_date, teacher_id,matiere_id) 
     VALUES (:student_id, :attendance_status, :attendance_date, :teacher_id,:matiere)
     ";
     $statement = $connect->prepare($query);
     $statement->execute($data);

     //PARTIE INCREMENTATION//
//     $query2="UPDATE tbl_student SET absence=absence+1 WHERE student_id=?";
   //  $statement2=$connect->prepare($query2);
    // $statement2->execute(array($student_id[$count]));
    }
    $output = array(
     'success'  => 'Ajout réussi'.$information,
    );
   
  }
  echo json_encode($output);
 }

 if($_POST["action"] == "index_fetch")
 {
    $query = "
    SELECT * FROM tbl_attendance 
    INNER JOIN tbl_student 
    ON tbl_student.student_id = tbl_attendance.student_id 
    INNER JOIN tbl_grade 
    ON tbl_grade.grade_id = tbl_student.student_grade_id 
    WHERE tbl_attendance.matiere_id = '".$_SESSION["matiere"]."' AND (";
    if(isset($_POST["search"]["value"]))
    {
     $query .= 'tbl_student.student_name LIKE "%'.$_POST["search"]["value"].'%" 
        OR tbl_student.student_roll_number LIKE "%'.$_POST["search"]["value"].'%" 
        OR tbl_grade.grade_name LIKE "%'.$_POST["search"]["value"].'%" )';
    }
  
    $query .= 'GROUP BY tbl_student.student_id ';
    if(isset($_POST["order"]))
    {
     $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
    }
    else
    {
     $query .= 'ORDER BY tbl_student.student_roll_number ASC ';
    }
  
    if($_POST["length"] != -1)
    {
     $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }
  
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $data = array();
    $filtered_rows = $statement->rowCount();
    foreach($result as $row)
    {
     $sub_array = array();
     $sub_array[] = $row["student_name"];
     $sub_array[] = $row["student_roll_number"];
     $sub_array[] = $row["grade_name"];
     $sub_array[] = get_attendance_percentage($connect, $row["student_id"],$_SESSION['matiere']);
     $sub_array[] = '<button type="button" name="report_button" id="'.$row["student_id"].'" class="btn btn-info btn-sm report_button">Report</button>';
     $data[] = $sub_array;
    }
  
    $output = array(
     "draw"    => intval($_POST["draw"]),
     "recordsTotal"  =>  $filtered_rows,
     "recordsFiltered" => get_total_records($connect, 'tbl_student'),
     "data"    => $data
    );
    echo json_encode($output);  
   }
}



?>
