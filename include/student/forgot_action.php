<?php
    include("admin/database_connection.php");
    session_start();
    $number_personne=0;
    if(isset($_POST)){
        if($_POST['action']=='envoyer'){


        $teacher_recovery=$_POST["student_recovery"];
        $recovery_addresse=$connect->prepare("SELECT * FROM tbl_student WHERE student_mail=?");
        $recovery_addresse->execute(array($teacher_recovery));
        $number_personne=$recovery_addresse->rowCount();
        echo $number_personne;
        }
        if(($_POST['action']=='send_mail')){
            $year = date("Y");
            $id_student=Get_student_id($connect, $_POST['addresse']);
            $name_addresse=Get_student_name($connect,$id_student);
            $roll=get_roll_number($connect,$id_student);
            $newPassword=$name_addresse.''.$roll.'+'.$year;
            update_pass_student($connect,$id_student,$newPassword);
           sendmail_student("university@gmail.com",$_POST['addresse'],$name_addresse,$_POST['addresse'],$newPassword);      
            
        }
    }

?>
