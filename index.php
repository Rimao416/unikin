<?php
    
    include('include/student/header.php');
    $req2=$connect->prepare("SELECT * FROM tbl_student
    INNER JOIN tbl_matiere
    ON tbl_student.student_grade_id=tbl_matiere.grade_id 
    WHERE tbl_student.student_id=?");
   //$req2->execute(array($_SESSION["student_id"]));
   $req2->execute(array($_SESSION["student_id"]));
   
   $color_list=['#0000FF','#8A2BE2','#A52A2A','#DEB887','#D2691E','#6495ED','#FF7F50','#DC143C',
    '#00008B','#B8860B','#006400','#8B008B'];
?>

<section>
                
                <div class="container__card">
                 <div class="header___container">
                     <div class="course_name">
                         <h3 style="font-family:poppins;font-weight:400;font-size:17px;color:#6923D0;">Accueil / <span style="color:rgb(88,97,105);">Cours</span></h3>
                     </div>
                 </div>
                 <?php
                   
                        $fetch2=$req2->fetchAll();
                        $i=0;
                        foreach($fetch2 as $row){  
                            
                            ?>
                        <a href="Cours.php?id=<?=$row['id_matiere']?>" style="color:rgb(72,72,72);">
                        <div class="card__user">
                            <div class="content__card">
                            <div class="card__img" style="background-color:<?=$color_list[$i];?>">
                                    <h2><?= explode_this($row['nom_matiere'])?></h2>
                                </div>
                                <div class="card__text">
                                <?=$row['nom_matiere']?>
                                </div>
                            </div>
                        </div>
                        </a>
                        <?php 
                         $i+=1;
                        }
                        ?>

         
                </div>
 
             </section>
</body>
</html>