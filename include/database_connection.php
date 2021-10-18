<?php
    $connect=new PDO("mysql:host=localhost;dbname=unikin","root","");
    $base_url="http://localhost/student/";
     function get_total_records($connect,$table_name){
         $query="SELECT * FROM $table_name";
         $statement=$connect->prepare($query);
         $statement->execute();
         return $statement->rowCount();
     }
     function load_grade_list($connect){
         $query="SELECT * FROM tbl_grade ORDER BY grade_name ASC";
         $statement=$connect->prepare($query);
         $statement->execute();
         $result=$statement->fetchAll();
         $output ='';
         foreach($result as $row){
             $output .='<option value="'.$row["grade_id"].'">'.$row["grade_name"].'</option>';
         }
         return $output;
     }
     function load_dept_list($connect){
        $query="SELECT * FROM departement ORDER BY nom_dep ASC";
        $statement=$connect->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll();
        $output ='';
        foreach($result as $row){
            $output .='<option value="'.$row["id"].'">'.$row["nom_dep"].'</option>';
        }
        return $output;
    }
     function load_fac_list($connect){
        $query="SELECT * FROM faculte ORDER BY section_name ASC";
        $statement=$connect->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll();
        $output ='';
        foreach($result as $row){
            $output .='<option value="'.$row["id"].'">'.$row["section_name"].'</option>';
        }
        return $output;
    }
     function make_avatar($character)
     {
         $path='avatar/'.time().'.png';
         $image=imagecreate(200,200);
         $red=rand(0,255);
         $green=rand(0,255);
         $blue=rand(0,255);
         imagecolorallocate($image, $red, $green, $blue);
         $textcolor=imagecolorallocate($image,255,255,255);
         imagettftext($image,100,0,20,150,$textcolor,realpath("ARIALBD.TTF"),$character);
         header('Content-type:image/png');
         imagepng($image,$path);
         imagedestroy($image);
         
     }
     function explode_this($character){
        $retour=''; 
        $first_letter=substr($character,0,1);
         $exploder=explode(' ',$character);
         
        if(sizeof($exploder)==1){
            $retour=ucfirst($first_letter);                
        }else{ 
            $retour=ucfirst($first_letter).''.strtolower($exploder[1][0]);
        }
        return $retour;
     }
     function load_teacher_list($connect){
         $query="SELECT * FROM tbl_teacher ORDER BY teacher_name ASC";
         $statement=$connect->prepare($query);
         $statement->execute();
         $result=$statement->fetchAll();
         $output='';
         foreach($result as $row){
             $output.='<option value="'.$row["teacher_id"].'">'.$row["teacher_name"].'</option>';
         }
         return $output;
     }
     function get_all($connect,$table,$search,$data,$result_data){
        $query="SELECT * FROM $table WHERE $search=?";
        $statement=$connect->prepare($query);
        $statement->execute(array($data));
        $result=$statement->fetch();
        return $result[$result_data];
     }
    function get_departement($connect,$search){
         $query="SELECT * FROM tbl_matiere
         INNER JOIN tbl_teacher ON tbl_matiere.id_prof=tbl_teacher.teacher_id
         WHERE tbl_teacher.teacher_id=?";
         $statement=$connect->prepare($query);
         $statement->execute(array($search));
         return $statement->rowCount();
     }
    function get_departement_user($connect,$search,$table,$table2,$inner,$inner2,$where,$retour){
         $query="SELECT * FROM $table
         INNER JOIN $table2 ON $inner=$inner2
         WHERE $where=?";
         $statement=$connect->prepare($query);
         $statement->execute(array($search));
         $result=$statement->fetch();
         return $result[$retour];
     }
/*     function get_name($connect,$name){

     }*/

     function get_attendance_percentage($connect, $student_id,$class)
     {
      $query = "SELECT ROUND((SELECT COUNT(*) FROM tbl_attendance WHERE attendance_status = 'Present'
       AND student_id = '".$student_id."' AND matiere_id='".$class."') 
      * 100 / COUNT(*)) AS percentage FROM tbl_attendance 
      WHERE student_id = '".$student_id."' AND matiere_id='".$class."'
      ";
     
      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
      foreach($result as $row)
      {
       if($row["percentage"] > 0)
       {
        return $row["percentage"] . '%';
       }
       else
       {
        return 'NA';
       }
      }
     }
     function get_attendance_percentage_admin($connect, $student_id)
     {
      $query = "SELECT ROUND((SELECT COUNT(*) FROM tbl_attendance WHERE attendance_status = 'Present' 
       AND student_id = '".$student_id."') 
      * 100 / COUNT(*)) AS percentage FROM tbl_attendance 
      WHERE student_id = '".$student_id."'
      ";
     
      $statement = $connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
      foreach($result as $row)
      {
       if($row["percentage"] > 0)
       {
        return $row["percentage"] . '%';
       }
       else
       {
        return 'NA';
       }
      }
     }
     if (!function_exists('str_contains')) {
        function str_contains(string $haystack, string $needle): bool
        {
            return '' === $needle || false !== strpos($haystack, $needle);
        }
    }
     function Get_student_name($connect,$student_id){
         $query="SELECT student_name FROM tbl_student WHERE student_id='".$student_id."'";
         $statement=$connect->prepare($query);
         $statement->execute();
         $result=$statement->fetchAll();
         foreach($result as $row){
             return $row["student_name"];
         }
     }
     function Get_Student_Con_Adresse($connect,$id){
        $query="SELECT * FROM tbl_student WHERE student_id=?";
        $statement=$connect->prepare($query);
        $statement->execute(array($id));
        $fetch_data=$statement->fetch();
        return $fetch_data['student_mail'];
     }
     function Get_student_grade_name($connect,$student_id){
        $query="SELECT tbl_grade.grade_name FROM tbl_student
        INNER JOIN tbl_grade 
        ON tbl_grade.grade_id=tbl_student.student_grade_id 
        WHERE tbl_student.student_id='".$student_id."'";
        $statement=$connect->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll();
        foreach($result as $row){
            return $row["grade_name"];
        }
    }
    function Get_student_grade_id($connect,$student_id){
        $query="SELECT tbl_grade.grade_id FROM tbl_student
        INNER JOIN tbl_grade 
        ON tbl_grade.grade_id=tbl_student.student_grade_id 
        WHERE tbl_student.student_id='".$student_id."'";
        $statement=$connect->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll();
        foreach($result as $row){
            return $row["grade_id"];
        }
    }

    function Get_student_teacher_name($connect,$student_id){
        $query="SELECT tbl_teacher.teacher_name 
        FROM tbl_student
        INNER JOIN tbl_grade
        ON tbl_grade.grade_id=tbl_student.student_grade_id 
        INNER JOIN tbl_teacher
        ON tbl_teacher.teacher_grade_id = tbl_grade.grade_id        
        WHERE tbl_student.student_id='".$student_id."'";
        $statement=$connect->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll();
        foreach($result as $row){
            return $row["teacher_name"];
      }
    }
    function Get_student_id($connect, $student){
        $query="SELECT * FROM tbl_student WHERE student_mail=?";
        $statement=$connect->prepare($query);
        $statement->execute(array($student));
        $result=$statement->fetch();
        return intval($result['student_id']);
    }
    function Get_teacher_id($connect, $teacher){
        $query="SELECT * FROM tbl_teacher WHERE teacher_emailid=?";
        $statement=$connect->prepare($query);
        $statement->execute(array($teacher));
        $result=$statement->fetch();
        return intval($result['teacher_id']);
    }
 /*   function generate_addresse($connect, $student){
        $generator='';
        $query="SELECT * FROM tbl_student WHERE student_id=?";
        $statement=$connect->prepare($query);
        $statement->execute(array($student));
        $result=$statement->fetch();
        $generator=$result['student_name'].''.$result['student_roll_number'].'@university.com';
        return $generator;
    }
    function get_student_id($connect,$student_name,$student_roll){
        $generator='';
        $query="SELECT * FROM tbl_student WHERE student_name=? AND student_roll_number=?";
        $statement=$connect->prepare($query);
        $statement->execute(array($student_name,$student_roll));
        $result=$statement->fetch();
        $generator=$result['student_id'];
        return intval($generator);
    }*/
    function teacher_name($connect, $teacher){
        $generator='';
        $query="SELECT * FROM tbl_matiere
        INNER JOIN tbl_teacher ON tbl_matiere.id_prof=tbl_teacher.teacher_id
        INNER JOIN tbl_grade ON tbl_matiere.grade_id=tbl_grade.grade_id WHERE tbl_matiere.id_prof='".$teacher."'";
        $statement=$connect->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll();
        foreach($result as $row){
            $generator =$row['teacher_name'];
        }
        return $generator;
    }
    /*
    function generate_password($connect, $teacher){
        $generator='';
        $query="SELECT * FROM tbl_matiere
        INNER JOIN tbl_teacher ON tbl_matiere.id_prof=tbl_teacher.teacher_id
        INNER JOIN tbl_grade ON tbl_matiere.grade_id=tbl_grade.grade_id WHERE tbl_matiere.id_prof='".$teacher."'";
        $statement=$connect->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll();
        foreach($result as $row){
            $generator =$row['teacher_name'].$row['id_prof'];
        }
        return $generator;
    }*/
    /*
    function generate_addresse_mail($connect, $student){
        $generator='';
        $query="SELECT * FROM tbl_matiere
        INNER JOIN tbl_teacher ON tbl_matiere.id_prof=tbl_teacher.teacher_id
        INNER JOIN tbl_grade ON tbl_matiere.grade_id=tbl_grade.grade_id WHERE tbl_matiere.id_prof='".$teacher."'";
        $statement=$connect->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll();
        foreach($result as $row){
            $generator =$row['teacher_emailid'];
        }
        return $generator;
    }*/
    function generate_id_matiere($connect,$matiere,$prof,$grade_id){
        $query="SELECT * FROM tbl_matiere WHERE matiere=? AND id_prof=? AND grade_id=?";
        $statement=$connect->prepare($query);
        $statement->execute(array($matiere,intval($prof),intval($grade_id)));
        $result=$statement->fetchAll();
        $id=0;
        foreach($result as $row){
            $id=intval($row['id_matiere']);
        }
        return $id;
    }
    function get_all_courses($connect,$mot){
        $query="SELECT * FROM tbl_teacher 
        INNER JOIN tbl_matiere ON tbl_matiere.id_prof=tbl_teacher.teacher_id WHERE tbl_teacher.teacher_id=?";
        $statement=$connect->prepare($query);
        $statement->execute(array($mot));
        $list_des_cours='';
        $row=$statement->rowCount();
        if($row==0){
            return "Aucun cours n'est attribué à ce prof";
        }else{
            $result=$statement->fetchAll();
            foreach($result as $row){
                $list_des_cours =$list_des_cours.' '.$row['matiere'];
            }
            return $list_des_cours;
        }
    }
    function get_courses_name($connect,$mot){
        $query="SELECT nom_dep FROM departement WHERE id=?";
        $statement=$connect->prepare($query);
        $statement->execute(array($mot));
        $fetch_data=$statement->fetch();
        return $fetch_data['nom_dep'];
    }
    function get_extension($file){
        $extension = pathinfo($file, PATHINFO_EXTENSION);
             return  $extension; 
    }
    function return_image($gile){
        $images=['jpeg','png','gif','tiff','bmp','jpeg','gif','tiff','pcx','rle','dib'];
        $word=['doc','docx'];
        $excel=['xls','xlxs'];
        $power_point=['ppt','pptx'];
        $compressed=['7z','arj','deb','pkg','rar','rpm','tar.gz','z','zip'];
        $retour='';
        if(in_array(get_extension($gile),$images)){
            $retour=" <img src='../public/img/image.png' href='img/image.png' alt='6'>";
        }elseif(in_array(get_extension($gile),$word)){
            $retour="<img src='../public/img/word.png' href='img/word.png' alt='5'>";
        }elseif(in_array(get_extension($gile),$excel)){
            $retour="<img src='../public/img/excel.png' href='img/excel.png' alt='4'>";
        }elseif(in_array(get_extension($gile),$power_point)){
            $retour="<img src='../public/img/power.png' href='img/power.png' alt='3'>";
        }elseif(in_array(get_extension($gile),$compressed)){
            $retour="<img src='../public/img/compressed.png' href='img/compressed.png' alt='2'>";
        }elseif(get_extension($gile)=='pdf'){
            $retour="<img src='../public/img/pdf.png' href='img/pdf.png' alt='1'>";
        }else{
            $retour="<img src='../public/img/els.png' href='img/els.png' alt='1'>";
        }
        return $retour;

    }

    //for users    
    function return_image2($gile){
        $images=['jpeg','png','gif','tiff','bmp','jpeg','gif','tiff','pcx','rle','dib'];
        $word=['doc','docx'];
        $excel=['xls','xlxs'];
        $power_point=['ppt','pptx'];
        $compressed=['7z','arj','deb','pkg','rar','rpm','tar.gz','z','zip'];
        $retour='';
        if(in_array(get_extension($gile),$images)){
            $retour=" <img src='public/img/image.png' href='img/image.png' alt='6'>";
        }elseif(in_array(get_extension($gile),$word)){
            $retour="<img src='public/img/word.png' href='img/word.png' alt='5'>";
        }elseif(in_array(get_extension($gile),$excel)){
            $retour="<img src='public/img/excel.png' href='img/excel.png' alt='4'>";
        }elseif(in_array(get_extension($gile),$power_point)){
            $retour="<img src='public/img/power.png' href='img/power.png' alt='3'>";
        }elseif(in_array(get_extension($gile),$compressed)){
            $retour="<img src='public/img/compressed.png' href='img/compressed.png' alt='2'>";
        }elseif(get_extension($gile)=='pdf'){
            $retour="<img src='public/img/pdf.png' href='img/pdf.png' alt='1'>";
        }else{
            $retour="<img src='public/img/els.png' href='img/els.png' alt='1'>";
        }
        return $retour;

    }
/*ZONE DE LISTCOURS.PHP*/

        
        function get_roll_number($connect,$id){
            $query="SELECT * FROM tbl_student WHERE student_id=?";
            $statement=$connect->prepare($query);
            $statement->execute(array($id));
            $fetch_data=$statement->fetch();
            return intval($fetch_data['student_roll_number']);
        }
        function get_student_addresse($connect,$id){
            $query="SELECT * FROM tbl_student WHERE student_id=?";
            $statement=$connect->prepare($query);
            $statement->execute(array($id));
            $fetch_data=$statement->fetch();
            return $fetch_data['student_addresse'];
        }
        function pata_nywila($connect,$id){
                $query="SELECT * FROM tbl_teacher WHERE teacher_id=?";
                $statement=$connect->prepare($query);
                $statement->execute(array($id));
                $fetch_data=$statement->fetch();
                return $fetch_data['teacher_password'];   
        }

        function get_teacher_classe($connect,$id){
            $query="SELECT * FROM tbl_matiere WHERE id_prof=?";
            $statement=$connect->prepare($query);
            $statement->execute(array($id));
            return $statement->rowCount();
        }
        function get_teacher_section($connect,$id){
            $query="SELECT * FROM tbl_section WHERE id_prof=?";
            $statement=$connect->prepare($query);
            $statement->execute(array($id));
            return $statement->rowCount();
        }
/*        function get_student_courses($connect,$id){
            $query=$connect->prepare("SELECT * FROM tbl_student
            INNER JOIN ")
        }*/
        function get_grade_number($connect,$id){
            $query="SELECT * FROM tbl_student
            INNER JOIN tbl_matiere
            ON tbl_student.student_grade_id=tbl_matiere.grade_id
            WHERE tbl_student.student_id=?";
            
            $statement=$connect->prepare($query);
            $statement->execute(array($id));
            return $statement->rowCount();
        }
        function get_presence_number($connect,$id){
            $status='Present';
            $query="SELECT * FROM tbl_student
            INNER JOIN tbl_attendance ON tbl_attendance.student_id=tbl_student.student_id 
            WHERE tbl_student.student_id=?
            AND tbl_attendance.attendance_status=?";
            $statement=$connect->prepare($query);
            $statement->execute(array($id,$status));
            return $statement->rowCount();
        }
        function get_absence_number($connect,$id){
            $status='Absent';
            $query="SELECT * FROM tbl_student
            INNER JOIN tbl_attendance ON tbl_attendance.student_id=tbl_student.student_id 
            WHERE tbl_student.student_id=?
            AND tbl_attendance.attendance_status=?";
            $statement=$connect->prepare($query);
            $statement->execute(array($id,$status));
            return $statement->rowCount();
        }
/*        function am_i_teacher($connect)
            return True 
            //return False


*/
function sendmail($fromMail,$to,$name,$prenom,$addresse,$password){
    $message='';
    $subject="Recuperation du compte";
    $headers = "MIME-Version: 1.0"."\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
    $headers .= 'From: Omarkayumba12345@gmail.com'."\r\n". 'Reply-to: Omarkayumbzsdqdq@gmail.com'."\r\n".'X-Mailer:PHP/'.phpversion();
    $message='<!doctype html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
        <title>Document</title>
    </head>
    <body style="font-family:roboto;font-weight:700;">
    <hr>
    <center>
    <strong>Cher Professeur(e) '.$name.'  '.$prenom.'</strong> <br>
        
    <h5>Vos coordonnées ont bel et bien été mises à jour</h5> 
    <h5>Addresse Mail : <strong>'.$addresse.'</strong> </h5>
    
    <h5> Nouveau Mot de passe: <strong>'.$password.'</strong> </h5>
    <br>
    <a href="http://localhost/attendace/teacher/login.php" style="text-decoration:none;background-color:#7460ee;padding:10px 10px;border:none;border-raidus:150px;color:white;font-size:16px;">Me connecter à Nouveau</a> <br>
     <h6>En vérifiant votre adresse e-mail ou en vous connectant au site Web, <br> vous confirmez avoir accepté et compris <br>
      les spécificités du système</h6>
    </center>
    <hr>
    </body>
    </html>';
        $result=mail($to,$subject,$message,$headers);             
    }



    function sendmail_student($fromMail,$to,$name,$addresse,$password){
        $message='';
        $subject="Recuperation du compte";
        $headers = "MIME-Version: 1.0"."\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
        $headers .= 'From: Omarkayumba12345@gmail.com'."\r\n". 'Reply-to: Omarkayumbzsdqdq@gmail.com'."\r\n".'X-Mailer:PHP/'.phpversion();
        $message='<!doctype html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie-edge">
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
            <title>Document</title>
        </head>
        <body style="font-family:roboto;font-weight:700;">
        <hr>
        <center>
        <strong>Cher(e) Etudiant(e) '.$name.'</strong> <br>
            
        <h5>INFORMATIONS DU COMPTE</h5> 
        <h5>Addresse Mail : <strong>'.$addresse.'</strong> </h5>
        
        <h5> Nouveau Mot de passe: <strong>'.$password.'</strong> </h5>
        <br>
        <a href="http://localhost/attendace/login.php" style="text-decoration:none;background-color:#7460ee;padding:10px 10px;border:none;border-raidus:150px;color:white;font-size:16px;">Me connecter à Nouveau</a> <br>
         <h6>En vérifiant votre adresse e-mail ou en vous connectant au site Web, <br> vous confirmez avoir accepté et compris <br>
          les spécificités du système</h6>
        </center>
        <hr>
        </body>
        </html>';
            $result=mail($to,$subject,$message,$headers);             
        }








    function update_pass_teacher($connect,$id,$password){
        $query=$connect->prepare("UPDATE tbl_teacher SET teacher_password=? WHERE teacher_id=?");
        $query->execute(array(password_hash($password,PASSWORD_DEFAULT),$id));
    }
    
    function update_pass_student($connect,$id,$password){
        $query=$connect->prepare("UPDATE tbl_student SET student_password=? WHERE student_id=?");
        $query->execute(array(password_hash($password,PASSWORD_DEFAULT),$id));
    }
    /*
    function delete_all_courses($connect,$id){
        $query=$connect->prepare("DELETE FROM tbl_matiere WHERE id_prof=?");
        $query->execute(array($id));
        $query=$connect->prepare("DELETE FROM tbl_matiere WHERE id_prof=?");
        $query->execute(array($id));
    }*/
    /*
    function get_all_id($connect,$id){
        
    }*/
    function get_teacher_matiere($connect,$id){
        $query=$connect->prepare("SELECT * FROM tbl_matiere WHERE id_prof=?");
        $query->execute(array($id));               
        $i=0;
        $go=true;
        while($i<$query->rowCount()){

            while($response=$query->fetch()){
                
                $query_response=$connect->prepare("SELECT * FROM tbl_section WHERE id_matiere=?");
                $query_response->execute(array($response['id_matiere']));
                
                while($resultat=$query_response->fetch()){
                   $query_courses=$connect->prepare("DELETE FROM  tbl_cours WHERE id_section=?");
                    $query_courses->execute(array($resultat['section_id']));                
                }
            }
            $i++;
        }
            $query_section=$connect->prepare("DELETE FROM tbl_section WHERE id_prof=?");
            $query_section->execute(array($id));
            $query_mat=$connect->prepare("DELETE FROM tbl_matiere WHERE id_prof=?");
            $query_mat->execute(array($id));
   
        }

        /*$responsee=$query->fetchAll();
        foreach($responsee as $row){
            return $row['id_matiere'];
        }*/
       /* while($response=$query->fetch()){
            return $response['id_matiere'].' '.$response['matiere'].'</br>';
        }*/
        
    
    function sendmail_teacher_register($fromMail,$to,$name,$prenom,$addresse,$password){
        $message='';
        $subject="INFORMATION COMPTE";
        $headers = "MIME-Version: 1.0"."\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
        $headers .= 'From: Omarkayumba12345@gmail.com'."\r\n". 'Reply-to: Omarkayumbzsdqdq@gmail.com'."\r\n".'X-Mailer:PHP/'.phpversion();
        $message='<!doctype html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie-edge">
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
            <title>Document</title>
        </head>
        <body style="font-family:roboto;font-weight:700;">
        <hr>
        <center>
        <strong>BIENVENUE AU SEIN DE NOTRE UNIVERSITE</strong>
        <strong>Cher Professeur(e) '.$name.'  '.$prenom.'</strong> <br>
            
        <h5>Voici vos coordonnées de connexion</h5> 
        <h5>Addresse Mail : <strong>'.$addresse.'</strong> </h5>
        
        <h5> Nouveau Mot de passe: <strong>'.$password.'</strong> </h5>
        <br>
        <a href="http://localhost/attendace/teacher/login.php" style="text-decoration:none;background-color:#7460ee;padding:10px 10px;border:none;border-raidus:150px;color:white;font-size:16px;">Me connecter</a> <br>
         <h6>En vérifiant votre adresse e-mail ou en vous connectant au site Web, <br> vous confirmez avoir accepté et compris <br>
          les spécificités du système</h6>
        </center>
        <hr>
        </body>
        </html>';
            $result=mail($to,$subject,$message,$headers);             
        }
        function send_student_mail($fromMail,$to,$name,$addresse,$password){
            $message='';
            $subject="Coordonnées du compte";
            $headers = "MIME-Version: 1.0"."\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
            $headers .= 'From: Omarkayumba12345@gmail.com'."\r\n". 'Reply-to: Omarkayumbzsdqdq@gmail.com'."\r\n".'X-Mailer:PHP/'.phpversion();
            $message='<!doctype html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie-edge">
                <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
                <title>Document</title>
            </head>
            <body style="font-family:roboto;font-weight:700;">
            <hr>
            <strong>Cher(e) Etudiant(e) '.$name.'</strong> <br>
                
            <h5>INFORMATIONS DU COMPTE</h5> 
            <h5>Id de Connexion : <strong>'.$addresse.'</strong> </h5>
            
            <h5> Mot de passe: <strong>'.$password.'</strong> </h5>
            <br>
            <a href="http://localhost/attendace/login.php" style="text-decoration:none;background-color:#7460ee;padding:10px 10px;border:none;border-raidus:150px;color:white;font-size:16px;">Me connecter</a> <br>
             <h6>En vérifiant votre adresse e-mail ou en vous connectant au site Web, <br> vous confirmez avoir accepté et compris <br>
              les spécificités du système</h6>
            <hr>
            </body>
            </html>';
                $result=mail($to,$subject,$message,$headers);               
        }

?>
