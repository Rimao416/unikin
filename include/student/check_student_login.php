<?php
    include("../database_connection.php");
    session_start();
    $student_emailid='';
    $student_password='';
    $error_student_emailid='';
    $error_student_password='';
    $error=0;
    if(empty($_POST["student_emailid"]))
    {
        $error_student_emailid ='Addresse Mail de connexion est réquise';
        $error++;
    }
    else{
        $student_emailid=$_POST["student_emailid"];
    }
    if(empty($_POST["student_password"]))
    {
        $error_student_password='Le mot de passe est réquis';
        $error++;
    }
    else{
        $student_password=$_POST["student_password"];
    }
    if($error==0){
        $query="SELECT * FROM tbl_student WHERE student_addresse ='".$student_emailid."'";
        $statement=$connect->prepare($query);
        if($statement->execute()){
            $total_row=$statement->rowCount();
            if($total_row > 0){
                $result=$statement->fetchAll();
                foreach($result as $row){
                    if(password_verify($student_password, $row["student_password"])){
                        $_SESSION["student_id"]=$row["student_id"];
                    }else{
                        $error_student_password="Mauvais Mot de Passe";
                        $error++;
                    }
                }
            }else{
                $error_student_emailid="Mauvaise addresse Mail";
                $error++;
            }
        }
    }
    if($error > 0){
        $output=array(
            'error'=>true,
            'error_student_emailid'=>$error_student_emailid,
            'error_student_password'=>$error_student_password
        );
    }else{
        $output=array(
            'success'=>true
        );


    }
    echo json_encode($output);



?>