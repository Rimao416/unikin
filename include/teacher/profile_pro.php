<?php
    include('../admin/database_connection.php');
    session_start();
    $output='';
   
    if(isset($_POST['action'])){
        if($_POST['action']=='teach'){
            $output = array(
                'teacher_name'       => get_teacher_name($connect,$_SESSION['teacher_id']),
                'teacher_addresse'    => get_teacher_addresse($connect,$_SESSION['teacher_id']),
                'teacher_living'=> get_teacher_living_addresse($connect,$_SESSION['teacher_id']),
                'teacher_profile'=>get_teacher_profile($connect,$_SESSION['teacher_id']),
                'teacher_prenom'=>get_teacher_Prenom($connect,$_SESSION['teacher_id'])
            );
            echo json_encode($output);
        }elseif($_POST['action']=='prof_modification'){
            $name=$_POST['teacher_name'];
            $prenom=$_POST['teacher_prenom'];
            $mail_teacher=$_POST['teacher_mail'];
            $living=$_POST['teacher_living'];
            $data = array(
                ':teacher_name'    => $name,
                ':teacher_mail'=>$mail_teacher,
                ':teacher_living'   => $living,
                ':teacher_prenom'=>$prenom,
                ':teacher_id' => $_SESSION['teacher_id']);
            $changement_request=$connect->prepare("UPDATE tbl_teacher 
            SET teacher_name = :teacher_name,
            teacher_emailid= :teacher_mail,
            teacher_qualification=:teacher_prenom, 
            teacher_address = :teacher_living
            WHERE teacher_id = :teacher_id");
            $changement_request->execute($data);
        }elseif($_POST['action']=='del_modification'){
            $error_identique='';
            $error_confirm='';
            $error=0;
            
            $actual_pass=pata_nywila($connect,$_SESSION['teacher_id']);
            $password=$_POST['password'];
            $new_password=$_POST['new_pass'];
            $conf_pass=$_POST['confirm_pass'];
            if(password_verify($password, $actual_pass)){
                if($new_password==$conf_pass){
                    $error=0;
                    $data = array(
                        ':teacher_password'    =>password_hash($new_password, PASSWORD_DEFAULT),
                        ':teacher_session'=>$_SESSION['teacher_id']);
                    $password_request=$connect->prepare("UPDATE tbl_teacher 
                    SET teacher_password = :teacher_password
                    WHERE teacher_id = :teacher_session");
                    $password_request->execute($data);
                }else{
                    $error_confirm='Veuillez correspondre les deux mots de passe';
                    $error++;
                }
            }else{
                $error_identique="Le mot de passe tapé ne correspond pas l'actuel";
                $error++;
            }
            if($error>0){
                $output=array(
                    'error'=>true,
                    'error_identique'=>$error_identique,
                    'error_confirm'=>$error_confirm
                );
            }elseif($error==0){
                $output = array(
                    'success'=> true
                );
            }

            echo json_encode($output);
        }

    }

?>