<?php

//grade_action.php

include('../database_connection.php');
session_start();
$output = '';
if(isset($_POST["action"]))
{
 if($_POST["action"] == 'fetch')
 {
  $query = "SELECT * FROM tbl_matiere 
  INNER JOIN departement ON tbl_matiere.id_dept=departement.id
  INNER JOIN faculte ON tbl_matiere.id_faculte=faculte.id
  INNER JOIN tbl_teacher ON tbl_matiere.id_prof=tbl_teacher.teacher_id
  INNER JOIN tbl_grade ON tbl_matiere.grade_id=tbl_grade.grade_id
  ";
 /* if(isset($_POST["search"]["value"]))
  {
   $query .= 'WHERE departement.nom_dep LIKE "%'.$_POST["search"]["value"].'%" ';
  }*/
  if(isset($_POST["order"]))
  {
   $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
  }
  else
  {
   $query .= 'ORDER BY id_matiere DESC ';
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
   $sub_array[] = $row['nom_dep'];
   $sub_array[] =$row['section_name'];
   $sub_array[] =$row['teacher_name'];  
   $sub_array[] =$row['grade_name'];
   $sub_array[] =$row['nom_matiere'];
   $sub_array[] = '<button type="button" name="edit_matiere" class="btn btn-primary btn-sm edit_matiere" id="'.$row["id_matiere"].'">Modifier</button>';
   $sub_array[] = '<button type="button" name="delete_matiere" class="btn btn-danger btn-sm delete_matiere" id="'.$row["id_matiere"].'">Supprimer</button>';
   
    $data[] = $sub_array;
  }
 /* $sub_array[] = $row["section_name"];
   $sub_array[] = $row["teacher_name"];*/
//   $sub_array[] = $row["grade_name"]; 
//  
$output = array(
   "draw"    => intval($_POST["draw"]),
   "recordsTotal"  =>  $filtered_rows,
   "recordsFiltered" => get_total_records($connect, 'tbl_matiere'),
   "data"    => $data
  );
  echo json_encode($output);
 }

 if($_POST["action"] == 'Add' || $_POST["action"] == "Edit")
 {
  $matiere='';
  $matiere_name =0;
  $teacher_id=0;
  $grade_id=0;
  $error_matiere_name = '';
  $error_grade_id='';
  $error_teacher_id='';
  $error_mat='';
  $error = 0;
  if(empty($_POST["matiere"]))
  {
   $error_mat = 'Le nom de la matière est réquise';
   $error++;
  }
  else
  {
   $matiere = $_POST["matiere"];
  }
  if(empty($_POST["matiere_name"]))
  {
   $error_matiere_name = 'Le nom de la matière est réquise';
   $error++;
  }
  else
  {
   $matiere_name = $_POST["matiere_name"];
  }
  if(empty($_POST["teacher_grade_id"]))
  {
   $error_grade_id = 'Remplissez correctement ce champ';
   $error++;
  }
  else
  {
   $teacher_id = $_POST["teacher_grade_id"];
  }  
  if(empty($_POST["grade_id"]))
  {
   $error_teacher_id = 'Veuillez le departement';
   $error++;
  }
  else
  {
   $grade_id = $_POST["grade_id"];
  }

  if($error > 0)
  {

   $output = array(
    'error'       => true,
    'error_grade_name'    => $error_matiere_name,
    'error_grade_id'=>$error_grade_id,
    'error_teacher_id'=>$error_teacher_id,
    'error_mat'=>$error_mat
   );
  }
  else
  {
   if($_POST["action"] == "Add")
   {

       $data=array(
        ':matiere_name'=>$matiere_name,
        'id_faculte'=>1,
        ':teacher_id'=>$teacher_id,
        ':grade_id'=>$grade_id,
        ':matiere'=>$matiere  
      );
//      make_avatar(explode_this($matiere_name));
     $query = "INSERT INTO tbl_matiere (id_dept,nom_matiere,id_faculte,id_prof,grade_id) SELECT * FROM (SELECT :grade_id,:matiere,:id_faculte,:teacher_id,:matiere_name) as temp 
    WHERE NOT EXISTS (
     SELECT nom_matiere FROM tbl_matiere WHERE nom_matiere = :matiere
    ) LIMIT 1";

//    $query="INSERT INTO tbl_matiere (matiere, id_prof, grade_id) VALUES (?,?,?)";
    $statement = $connect->prepare($query);
    if($statement->execute($data))
    {

        if($statement->rowCount() > 0)

     {
        $output = array(
         'success'  => 'Data Added Successfully',
      );
    }
     else
     {
      $output = array(
       'error'     => true,
       'error_matiere_name' => 'Cette matiere existe déjà'
      );
     }
    }
   }
   if($_POST["action"] == "Edit")
   {
 $data = array(
    ':matiere_id'=>$_POST["matiere_id"],
     ':matiere_name' => strtoupper($matiere_name),
    ':teacher_id'=>$teacher_id,
    ':grade_id'=>$grade_id
    );
/*    UPDATE tbl1 SET Status = 'Finished' 
WHERE id = (SELECT id 
FROM tbl1 
WHERE NOT EXISTS (SELECT id FROM tbl1_temp 
WHERE tbl1.id = tbl1_temp.id))*/
    $query = "
    UPDATE tbl_matiere
    SET matiere = :matiere_name,
    id_prof=:teacher_id,
    grade_id=:grade_id 
    WHERE id_matiere = :matiere_id
    ";
/*    $query = "
    UPDATE tbl_matiere
    SET matiere = :matiere_name,
    id_prof=:teacher_id,
    grade_id=:grade_id 
    WHERE id_matiere = (SELECT id_matiere FROM tbl_matiere WHERE NOT EXISTS (SELECT matiere FROM tbl_matiere WHERE matiere =:matiere_name))";*/
    $statement = $connect->prepare($query);  
    if($statement->execute($data))
    {
     $output = array(
      'success'  => 'Data Updated Successfully'
     );
    }
   }
  }
  echo json_encode($output);
 }

 if($_POST["action"] == "edit_fetch")
 {
  $query = "SELECT * FROM tbl_matiere WHERE id_matiere = '".$_POST["matiere_id"]."'";
  $statement = $connect->prepare($query);
  $name="";
  $id="";
  $classe=0;
  $grade=0;
  if($statement->execute())
  {
   $result = $statement->fetchAll();
   foreach($result as $row)
   {
    $name=$row["matiere"];
    $id=$row["id_matiere"];
    $classe=intval($row["id_prof"]);
    $grade=intval($row["grade_id"]);
   }
   $output=array(
    'matiere_name'=>$name,
    'matiere_id'=>$id,
    'prof'=>$classe,
    'grade'=>$grade
   );
   echo json_encode($output);

  }
 }

 if($_POST["action"] == "delete")
 {
  $query = "DELETE FROM tbl_matiere WHERE id_matiere = '".$_POST["matiere_id"]."'";
  $statement = $connect->prepare($query);
  if($statement->execute())
  {
    $query='DELETE FROM tbl_teacher_login WHERE id_matiere=?';
    $statement=$connect->prepare($query);
    $statement->execute(array($_POST['matiere_id']));
   echo 'Data Delete Successfully';
  }
 }
}

?>