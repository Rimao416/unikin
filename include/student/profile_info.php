<?php
    include('admin/database_connection.php');
    session_start();
    $output='';
    if(isset($_POST['action'])){
        if($_POST['action']=='getinfo'){
            $output = array(
                'student_name'       => Get_student_name($connect,$_SESSION['student_id']),
                'grade_name'    => Get_student_grade_name($connect,$_SESSION['student_id']),
                'mail_student'=> Get_Student_Con_Adresse($connect,$_SESSION['student_id']),
                'student_addresse'=>get_student_addresse($connect,$_SESSION['student_id']),
                'roll_number'=>get_roll_number($connect,$_SESSION['student_id'])
            );
            echo json_encode($output);
        }elseif($_POST['action']=='modification'){
            $username=$_POST['Username'];
            $addresse=$_POST['Addresse'];
            $mail=$_POST['Addresse_Con'];
            $data = array(
                ':student_name'    => $username,
                ':student_mail'=>$mail,
                ':student_addresse'   => $addresse,
                ':student_id' => $_SESSION['student_id']);
            $changement_request=$connect->prepare("UPDATE tbl_student 
            SET student_name = :student_name,
            student_mail= :student_mail, 
            student_addresse = :student_addresse
            WHERE student_id = :student_id");
            $changement_request->execute($data);

        }

    }

?>