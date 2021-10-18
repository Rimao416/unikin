<?php
    include("../database_connection.php");
    session_start();
    $teacher_emailid='';
    $teacher_password='';
    $error_teacher_emailid='';
    $error_teacher_password='';
    $error=0;
    if(empty($_POST["teacher_emailid"]))
    {
        $error_teacher_emailid ='Addresse Mail est réquise';
        $error++;
    }
    else{
        $teacher_emailid=$_POST["teacher_emailid"];
    }
    if(empty($_POST["teacher_password"]))
    {
        $error_teacher_password='Le mot de passe est réquis';
        $error++;
    }
    else{
        $teacher_password=$_POST["teacher_password"];
    }
    if($error==0){
        $query="SELECT * FROM tbl_teacher WHERE teacher_emailid ='".$teacher_emailid."'";
        $statement=$connect->prepare($query);
        if($statement->execute()){
            $total_row=$statement->rowCount();
            if($total_row > 0){
                $result=$statement->fetchAll();
                foreach($result as $row){
                    if(password_verify($teacher_password, $row["teacher_password"])){
                        $_SESSION["teacher_id"]=$row["teacher_id"];
                    }else{
                        $error_teacher_password="Mauvais Mot de Passe";
                        $error++;
                    }
                }
            }else{
                $error_teacher_emailid="Mauvaise addresse Mail";
                $error++;
            }
        }
    }
    if($error > 0){
        $output=array(
            'error'=>true,
            'error_teacher_emailid'=>$error_teacher_emailid,
            'error_teacher_password'=>$error_teacher_password
        );
    }else{
        $output=array(
            'success'=>true
        );


    }
    echo json_encode($output);
    if(isset($_POST['action'])){
        if($_POST['action']=='load_action'){
            $data=$connect->prepare("SELECT distinct (tbl_grade.grade_name),tbl_grade.grade_id,
            tbl_matiere.grade_id FROM tbl_grade
            INNER JOIN tbl_matiere ON tbl_matiere.grade_id=tbl_grade.grade_id
            WHERE id_prof=?");
            $data->execute(array($_SESSION['teacher_id']));
            $fetch=$data->fetchAll();
            $nombre=$data->rowCount();
            $sortie='';

            if($nombre==0){
                $sortie.='<div class="box">
                    <h3 class="Unique">AUCUN COURS NE VOUS AI ATTRIBUE, CONTACTEZ L\'ADMINISTRATION
                </div>';
            }else{
                $sortie='<div class="container-title">
                </div>
                <div class="box">
                    <h3 class="Unique">CHOISSEZ VOTRE SALLE</h3>
                    <div class="modal">';
    
                foreach($fetch as $row){
                    $sortie .='<div id="card1" data-grade_id="'.$row['grade_id'].'">
                    <div class="text">
                        <h3>'.$row['grade_name'].'</h3>
                       
                    </div>
    
                        </div>';
                }
                $sortie.='</div>
                        </div>';
    
            }
            echo $sortie;
        }
        if($_POST['action']=='classe'){
            $data=$connect->prepare("SELECT * FROM tbl_matiere
            INNER JOIN departement ON tbl_matiere.id_dept=departement.id
            WHERE id_prof=? AND tbl_matiere.grade_id=?");
            $data->execute(array($_SESSION['teacher_id'],$_POST['grade_id']));
            $fetch=$data->fetchAll();
            $nombre=$data->rowCount();
            $sortie='';
                $sortie='<div class="container-title2">
                </div>
                <div class="box2">
                    <h3 class="Unique2">CHOISSEZ VOTRE COURS DE CONNEXION</h3>
                    <div class="modal2">';
    
                foreach($fetch as $row){
                    $sortie .='<div id="card2" data-matiere_id="'.$row['id_matiere'].'">
                    <div class="text2">
                        <h3>'.$row['nom_matiere'].'</h3>
                       
                    </div>
    
                        </div>';
                }
                $sortie.='</div>
                        </div>';
    
            
            echo $sortie;
            
        }
        if($_POST['action']=='matiere'){
            $_SESSION['matiere']=$_POST['matiere_id'];

        }
    }


?>