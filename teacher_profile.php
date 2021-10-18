<?php
    include('header.php');    
    $id_teacher=$_GET['id_teacher'];
    if(!isset($_GET['id_teacher'])||($_GET['id_teacher']=='')||($_GET['id_teacher']!=$id_teacher)){
        echo "<script>location.href='error.php'</script>";
    }else{
        $color_list=['rgba(0,0,255,0.6)','rgba(138,43,226,.6)','rgba(165,42,42,.6)','rgba(222,184,135,.6)','rgba(95,158,160,.6)','rgba(210,105,30,.6)','rgba(0,0,139,.6)','rgba(139,0,139,.6)','rgba(153,50,204,.6)','rgba(72,61,139,.6)',
        'rgba(75,0,130,.6)','rgba(128,128,0,.6)'];
        $color_list2=['rgb(0,0,255)','rgb(138,43,226)','rgb(165,42,42)','rgb(222,184,135)','rgb(95,158,160)','rgb(210,105,30)','rgb(0,0,139)','rgb(139,0,139)','rgb(153,50,204)','rgb(72,61,139)','rgb(75,0,130)',
        'rgb(128,128,0)'];
        
         $id_grade=intval(Get_student_grade_id($connect,$_SESSION['student_id']));
         $recent_courses=$connect->prepare("SELECT * FROM tbl_matiere 
         INNER JOIN tbl_section ON tbl_section.id_matiere=tbl_matiere.id_matiere
         INNER JOIN tbl_teacher ON tbl_teacher.teacher_id=tbl_section.id_prof
         WHERE tbl_matiere.grade_id=? AND tbl_teacher.teacher_id=? ORDER BY tbl_matiere.id_matiere");
         $recent_courses->execute(array($id_grade,$id_teacher));
    }
?>
    <div class="header___container">
            <div class="course_name">
                <h3 style="font-family:poppins;font-weight:400;font-size:17px;color:#6923D0;">Accueil / <a  href="index.php" style="color:rgb(88,97,105);">Cours</a>/ <a  href="profile.php" style="color:rgb(88,97,105);">Profile</a> / <a  href="cours.php" style="color:rgb(88,97,105);"></a> <span><?=ucfirst(get_name($connect,$id_teacher))?></span> </h3>
            </div>
    </div>
<center>
    <div class="teacher_header">
        <img src="admin/teacher_image/<?=get_teacher_profile($connect,$id_teacher)?>" alt="">
        <h3> <?=ucfirst(get_name($connect,$id_teacher))?></h3>
        <h6><?=get_teacher_addresse($connect,$id_teacher)?></h6>
        <p class="State">Professeur</p>
        <hr class="teacher_underline">
        <h6 class="teacher_courses_name">Professeur en <?= Get_student_grade_name($connect,$_SESSION['student_id'])?></h6>
        <hr class="teacher_underline">
    </div>
</center>
    <div class="teacher_course_profile">
        <div class="teacher_courses_title">
            <h4 style="color: rgb(72,72,72);font-weight:400;font-family:roboto;">Cour(s) du Professeur</h4>
            <pre></pre>
        </div>
        <?php
            $courses_fetch_recent=$recent_courses->fetchAll();
            $i=0;
            foreach($courses_fetch_recent as $row_recent){  
        ?>
        <div class="teacher_courses_pro" data-courses_teacher="<?=$row_recent['section_id']?>">
            <div class="box__teacher">
                <div class="content__first" style="background-color:<?=$color_list[$i]?>;border-left:5px double <?=$color_list2[$i];?>">
                        <h2><?=explode_this($row_recent['section_name'])?></h2>
                    </div>
                          
                    <div class="content__text">
                        <h4><?=$row_recent['matiere']?></h4>
                        <h5 style="color: #6923D0;"><?=$row_recent['section_name']?></h5>
                        <div id="sub__courses" class="sub__courses">
                            <h4></h4>
                        </div>
                    </div>
                </div>                
        </div>
        <?php 
            $i+=1;
                    }
        ?>


    </div>
<script>
     $(document).on('click','.teacher_courses_pro',function(){
            var id_teacher=$(this).data('courses_teacher')
            location.href="detailsCours.php?Cours_action="+id_teacher;
        })
</script>
</body>
</html>