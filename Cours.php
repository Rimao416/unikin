<?php
    
    include('include/student/header.php');
    if(isset($_GET['id'])){
        $query_courses=$connect->prepare("SELECT * FROM tbl_section
        INNER JOIN tbl_teacher ON tbl_teacher.teacher_id=tbl_section.id_prof
         WHERE id_matiere=?");
    
        $query_courses->execute(array($_GET['id']));
        $fetchQuery=$query_courses->fetchAll();
        $rowNumber=$query_courses->rowCount();
        $color_list=['rgba(0,0,255,0.6)','rgba(138,43,226,.6)','rgba(165,42,42,.6)','rgba(222,184,135,.6)','rgba(95,158,160,.6)','rgba(210,105,30,.6)','rgba(0,0,139,.6)','rgba(139,0,139,.6)','rgba(153,50,204,.6)','rgba(72,61,139,.6)',
        'rgba(75,0,130,.6)','rgba(128,128,0,.6)'];
        $color_list2=['rgb(0,0,255)','rgb(138,43,226)','rgb(165,42,42)','rgb(222,184,135)','rgb(95,158,160)','rgb(210,105,30)','rgb(0,0,139)','rgb(139,0,139)','rgb(153,50,204)','rgb(72,61,139)','rgb(75,0,130)',
        'rgb(128,128,0)'];
        $i=0;   
    }else{
        echo "<script> location.href='error.php'</script>";
    }
    
    
    
?>
    <div class="container-fluid">
        <div class="row" id="SectionCours">
            <div class="col-md-12" >
                <div class="lessons__container">

                   
                    <div class="courses__posed">
                        <div class="lessons_title">
                            <h2>Lessons</h2>
                            <hr> 
                        </div>
                        <?php foreach($fetchQuery as $row){
                             
                        ?>

                        <div class="lessons__content" id="lessons_id" data-courses_id="<?=$row['section_id']?>">
                            <div class="content__first" style="background-color:<?=$color_list[$i];?>;border-left:5px double <?=$color_list2[$i];?>">
                                    <h2><?= explode_this($row['section_name'])?></h2>
                            </div>
                           
                            <div class="content__text">
                                <h4><?=$row['section_name'] ?></h4>
                                <h5 style="color:#ccc;"><em>Deposé par le professeur <?=ucfirst($row['teacher_name'])?></em> </h5>
                                <div id="sub__courses" class="sub__courses<?=$row['section_id']?>">
                                    <h4></h4>
                                </div>

                            </div>        
                        </div>
                        <?php
                        $i+=1;
                    }
                    ?>
                    </div>
                </div>
            </div>        
        </div>
    </div>
<script src="public/js/student/student_courses_action.js"></script>
</body>
</html>