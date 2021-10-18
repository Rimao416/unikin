<?php

//student_action.php

include('../database_connection.php');
session_start();
$output = '';
if(isset($_POST["action"]))
{
 if($_POST["action"] == 'fetch')
 {
  $query = "
  SELECT * FROM tbl_student 
  INNER JOIN tbl_grade ON tbl_grade.grade_id = tbl_student.student_grade_id
  INNER JOIN faculte ON tbl_student.student_fac = faculte.id
  INNER JOIN departement ON tbl_student.student_dep = departement.id
  
  ";
  if(isset($_POST["search"]["value"]))
  {
   $query .= 'WHERE tbl_student.student_name LIKE "%'.$_POST["search"]["value"].'%" 
      OR tbl_student.student_roll_number LIKE "%'.$_POST["search"]["value"].'%" 
      OR tbl_student.student_dob LIKE "%'.$_POST["search"]["value"].'%" 
      OR tbl_grade.grade_name LIKE "%'.$_POST["search"]["value"].'%" ';
  }
  if(isset($_POST["order"]))
  {
   $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
  }
  else
  {
   $query .= 'ORDER BY tbl_student.student_id DESC ';
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
   $sub_array[]=$row["student_mail"];
   $sub_array[] = $row["student_roll_number"];
   $sub_array[]=$row["student_addresse"];
   $sub_array[] = $row["student_dob"];
   $sub_array[] = $row["grade_name"];
   $sub_array[] = $row["section_name"];
   $sub_array[] = $row["nom_dep"];
   $sub_array[] = '<button type="button" name="edit_student" class="btn btn-primary btn-sm edit_student" id="'.$row["student_id"].'">Edit</button>';
   $sub_array[] = '<button type="button" name="delete_student" class="btn btn-danger btn-sm delete_student" id="'.$row["student_id"].'">Delete</button>';
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

 if($_POST["action"] == 'Add' || $_POST["action"] == "Edit")
 {
  // $student_id=0;
$passowrd_student='';
  $student_name = '';
  $faculte='';
  $dep="";
  $student_dob = '';
  $student_grade_id = '';
  $error_student_name = '';
  $error_student_roll_number = '';
  $error_fac='';
  $error_student_dob = '';
  $error_student_grade_id = '';
  $error = 0;
  $error_dep='';

  
  if(empty($_POST["student_name"]))
  {
   $error_student_name = 'Student Name is required';
   $error++;
  }
  else
  {
   $student_name = $_POST["student_name"];
    $passowrd_student.=$student_name;
//    $student_id=get_student_id($connect,$student_name,$student_roll_number);  
  }
  if(empty($_POST["student_addresse"])){
    $error_student_addresse='L\'Adresse Mail est Réquise';
    $error++;
  }else{
    $student_addresse=$_POST['student_addresse'];
  }

  if(empty($_POST["student_fac_id"])){
    $error_fac='La faculté est réquise';
    $error++;
  }else{
    $faculte=$_POST['student_fac_id'];
  }

  if(empty($_POST["student_dep_id"])){
    $error_dep='Le département est requis';
    $error++;
  }else{
    $dep=$_POST['student_dep_id'];
  }

  if(empty($_POST["student_dob"]))
  {
   $error_student_dob = 'Student Date of Birth is required';
   $error++;
  }
  else
  {
   $student_dob = $_POST["student_dob"];
   
  }
  if(empty($_POST["student_grade_id"]))
  {
   $error_student_grade_id = 'Grade is required';
   $error++;
  }
  else
  {
   $student_grade_id = $_POST["student_grade_id"];
  }
  
  if($error > 0)
  {
   $output = array(
    'error'       => true,
    'error_student_name'   => $error_student_name,
    'error_student_roll_number'  => $error_student_roll_number,
    'error_student_dob'    => $error_student_dob,
    'error_student_grade_id'  => $error_student_grade_id,
    'error_fac'=>$error_fac,
    'error_dep'=>$error_dep
   );
  }
  else
  {
   if($_POST["action"] == "Add")
   {
  
    $student_roll_number = rand(1000,9999999);
    $connection=$student_roll_number;
    $passowrd_student =$student_name.$student_roll_number;
    send_student_mail("university@gmail.com",$student_addresse,$student_name,$student_addresse,$passowrd_student);
    
    //sendmail_student("university@gmail.com","omari@gmail.com","Kayumba Omari","omari@gmail.com","12345");
    $data = array(
     ':student_name'    => $student_name,
     ':student_mail'=>$student_addresse,
     ':student_roll_number'  => $student_roll_number,
     ':student_password'=>password_hash($passowrd_student, PASSWORD_DEFAULT),
     ':student_addresse'=>$connection,
     ':student_dob'    => $student_dob,
     ':student_grade_id'   => $student_grade_id,
     ':student_fac'=>$faculte,
     ':student_dep'=>$dep
    );
    $query = "
    INSERT INTO tbl_student 
    (student_name, student_mail, student_roll_number,student_password,student_addresse, student_dob, student_grade_id,student_fac,student_dep) 
    VALUES (:student_name,:student_mail, :student_roll_number,:student_password,:student_addresse, :student_dob, :student_grade_id,:student_fac,:student_dep)
    ";
    $statement = $connect->prepare($query);
    if($statement->execute($data))
    {
      $output = array(
      'success'  => 'Data Added Successfully',
     );

    }

   }
   if($_POST["action"] == "Edit")
   {
     $student_roll_number=get_roll_number($connect,$_POST['student_id']);
    $data = array(
     ':student_name'    => $student_name,
     ':student_mail'=>$student_addresse,
     ':student_roll_number'  => $student_roll_number,
     ':student_dob'    => $student_dob,
     ':student_addresse'=>$student_name.''.$student_roll_number.'@university.com',
     ':student_grade_id'   => $student_grade_id,
     ':student_fac'   => $faculte,
     ':student_dep'   => $dep,
     ':student_id'    => $_POST["student_id"]
    );
    $query = "
    UPDATE tbl_student 
    SET student_name = :student_name, 
    student_mail=:student_mail,
    student_roll_number = :student_roll_number, 
    student_dob = :student_dob,
    student_addresse=:student_addresse, 
    student_grade_id = :student_grade_id,
    student_fac= :student_fac,
    student_dep= :student_dep,
    WHERE student_id = :student_id
    ";
    $statement = $connect->prepare($query);
    if($statement->execute($data))
    {
     $output = array(
      'success'  => 'Data Edited Successfully',
     );
    }
   }
  }
  echo json_encode($output);
 }

 if($_POST["action"] == "edit_fetch")
 {
  $query = "SELECT * FROM tbl_student WHERE student_id = '".$_POST["student_id"]."'";
  $statement = $connect->prepare($query);
  $name="";
  $roll=0;
  $dob;
  $grade=0;
  $id_student=0;
  if($statement->execute())
  {
   $result = $statement->fetchAll();
   foreach($result as $row)
   {
    $name= $row["student_name"];
    $mail=$row['student_mail'];
    $roll = $row['student_roll_number'];
    $dob = $row['student_dob'];
    $grade = $row['student_grade_id'];
    $faculte_etudiant = $row['student_fac'];
    $depa_etudiant = $row['student_dep'];

    $id_student = $row['student_id'];
   }
   $output=array(
    'student_name'=>$name,
    'student_mail'=>$mail,
    'student_roll_number'=>$roll,
    'student_dob'=>$dob,
    'student_grade_id'=>$grade,
    'student_fac'=>$faculte_etudiant,
    'student_dep'=>$depa_etudiant,
    'student_id'=>$id_student
);
   echo json_encode($output);
  }
 }

 if($_POST["action"] == "delete")
 {
  $query = "
  DELETE FROM tbl_student 
  WHERE student_id = '".$_POST["student_id"]."'";
  $statement = $connect->prepare($query);
  if($statement->execute())
  {
   echo 'Data Delete Successfully';
  }
 }
}

?>