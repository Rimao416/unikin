<?php
    include('include/student/header.php');
    //*******************************PRESENT******************************* */
    $status='Present';
    $phrase='';
    $mot='';
    $nombre=$_SESSION['student_id'];
    $calcul='';
    $query=$connect->prepare("SELECT * FROM tbl_student
    INNER JOIN tbl_matiere 
    ON tbl_student.student_grade_id=tbl_matiere.grade_id 
    WHERE tbl_student.student_id=?");
    $query->execute(array($nombre));
    $ma_requete=$query->fetchAll();
    foreach($ma_requete as $row){
        $phrase=$row['nom_matiere'].',';
        $mot.=$phrase;
        $query2=$connect->prepare("SELECT * FROM tbl_attendance WHERE matiere_id=? AND student_id=? AND attendance_status=?");
        $query2->execute(array($row['id_matiere'],$nombre,$status));
        $calcul.=$query2->rowCount().',';
    }

        //*******************************ABSENT******************************* */
        $statusA='Absent';
        $phraseA='';
        $motA='';
        $nombreA=$_SESSION['student_id'];
        $calculA='';
        $queryA=$connect->prepare("SELECT * FROM tbl_student
        INNER JOIN tbl_matiere 
        ON tbl_student.student_grade_id=tbl_matiere.grade_id 
        WHERE tbl_student.student_id=?");
        $queryA->execute(array($nombreA));
        $ma_requeteA=$queryA->fetchAll();
     
        foreach($ma_requeteA as $rowA){
            $phraseA=$rowA['nom_matiere'].',';
            $motA.=$phraseA;
            $queryA=$connect->prepare("SELECT * FROM tbl_attendance WHERE matiere_id=? AND student_id=? AND attendance_status=?");
            $queryA->execute(array($rowA['id_matiere'],$nombreA,$statusA));
            $calculA.=$queryA->rowCount().',';
        }
        //Pour trouver le nombre des cours associés à un étudiant
        $req2=$connect->prepare("SELECT * FROM tbl_student
        INNER JOIN tbl_matiere
        ON tbl_student.student_grade_id=tbl_matiere.grade_id 
        INNER JOIN tbl_teacher
        ON tbl_teacher.teacher_id=tbl_matiere.id_prof
        WHERE tbl_student.student_id=?  ORDER BY tbl_matiere.id_matiere DESC LIMIT 3 ");
       //$req2->execute(array($_SESSION["student_id"]));
       
       $color_list=['rgba(0,0,255,0.6)','rgba(138,43,226,.6)','rgba(165,42,42,.6)','rgba(222,184,135,.6)','rgba(95,158,160,.6)','rgba(210,105,30,.6)','rgba(0,0,139,.6)','rgba(139,0,139,.6)','rgba(153,50,204,.6)','rgba(72,61,139,.6)',
       'rgba(75,0,130,.6)','rgba(128,128,0,.6)'];
       $color_list2=['rgb(0,0,255)','rgb(138,43,226)','rgb(165,42,42)','rgb(222,184,135)','rgb(95,158,160)','rgb(210,105,30)','rgb(0,0,139)','rgb(139,0,139)','rgb(153,50,204)','rgb(72,61,139)','rgb(75,0,130)',
       'rgb(128,128,0)'];
        $id_grade=intval(Get_student_grade_id($connect,$_SESSION['student_id']));
        $recent_courses=$connect->prepare("SELECT * FROM tbl_matiere 
        INNER JOIN tbl_section ON tbl_section.id_matiere=tbl_matiere.id_matiere
        INNER JOIN tbl_teacher ON tbl_teacher.teacher_id=tbl_section.id_prof
        WHERE tbl_matiere.grade_id=? ORDER BY tbl_matiere.id_matiere DESC LIMIT 3");
        $recent_courses->execute(array($id_grade));


        /*************************************************************************** */
        $attendance_query=$connect->prepare("SELECT * FROM tbl_attendance 
        INNER JOIN tbl_student 
        ON tbl_student.student_id=tbl_attendance.student_id
        INNER JOIN tbl_teacher 
        ON tbl_teacher.teacher_id=tbl_attendance.teacher_id
        INNER JOIN tbl_matiere 
        ON tbl_matiere.id_matiere=tbl_attendance.matiere_id
        WHERE tbl_student.student_id=? ORDER BY tbl_attendance.attendance_id LIMIT 6");
        $attendance_query->execute(array($_SESSION['student_id']));
        $attendance_fetch=$attendance_query->fetchAll();
        /*********************************GENERER LES COURS AINSI QUE LES ABSENCES************************************* */
       /* $load_courses=$connect->prepare("SELECT * FROM tbl_student
        INNER JOIN tbl_matiere 
        ON tbl_student.student_grade_id=tbl_matiere.grade_id 
        WHERE tbl_student.student_id=?");
        $load_courses->execute(array($_SESSION['student_id']));
        $fetch_load=$load_courses->fetchAll();*/
      /*  foreach($ma_requeteA as $rowM){
            $status='Absent';
            echo $rowM['matiere'];
            $query_Student=$connect->prepare("SELECT * FROM tbl_attendance WHERE matiere_id=? AND student_id=? AND attendance_status=?");
            $queryA->execute(array($rowA['matiere'],$_SESSION['student_id'],$status));
            $load_fetch=$queryA->fetchAll();
            foreach($load_fetch as $row_courses){
                echo $row_courses['attendance_status'];
            }
        }*/

?>