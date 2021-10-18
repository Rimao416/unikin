<?php
    include("../admin/database_connection.php");
    session_start();
    $number_personne=0;
    if(isset($_POST)){
        if($_POST['action']=='envoyer'){


        $teacher_recovery=$_POST["teacher_recovery"];
        $recovery_addresse=$connect->prepare("SELECT * FROM tbl_teacher WHERE teacher_emailid=?");
        $recovery_addresse->execute(array($teacher_recovery));
        $number_personne=$recovery_addresse->rowCount();
        echo $number_personne;
        }
        if(($_POST['action']=='send_mail')){
            $year = date("Y");
            
            $id_teacher=Get_teacher_id($connect, $_POST['addresse']);
            $name_addresse=get_teacher_name($connect,$id_teacher);
            $surname=get_teacher_Prenom($connect,$id_teacher);
            $newPassword=$name_addresse.''.$surname.'+'.$year;
            update_pass_teacher($connect,$id_teacher,$newPassword);
            sendmail("university@gmail.com",$_POST['addresse'],$name_addresse,$surname,$_POST['addresse'],$newPassword);      
            
        }
    }

?>
