<?php
    
include('pages/datauser.php');
?>
<div class="container">
            <div class="header___container">
                 <div class="course_name">
                    <h3 style="font-family:poppins;font-weight:400;font-size:17px;color:#6923D0;"> <a href="index.php">Accueil</a>  / <span style="color:rgb(88,97,105);">Profile</span></h3>
                </div>
            </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card__student">
                 <center> <img src="public/img/azer.png" alt=""></center>
                <center> <h5 style="color:black"><?=ucfirst($fetch1['student_name'])?></h5>
                    <h6 class="Others_Student">Etudiant</h6>
                    <h6 class="Others_Student"> <?=Get_student_grade_name($connect,$_SESSION['student_id'])?></h6>
                    <i class='bx bx-edit-alt' id="Index_Student_Custom" data-iduser="<?=$_SESSION['student_id']?>"></i>   
                </center>
            </div>
            <pre></pre>
        <?php include('pages/portofolio.php')?>
        </div>
        <div class="col-md-8">
            
            <div class="absence_courses">
            <b>Tableau de Bord</b> 
                <div class="row">    
                    <div class="col-6 chart">
                        <div class="chart__left">
                            <div class="total_courses">
                                    <div class="courses_letter">
                                        <h3 style="font-size: 19px;font-weight:400;">Cours</h3>
                                        <hr>
                                    </div>
                                    <div class="courses_nombre">
                                        <h4 style="font-weight:400;"><?=get_grade_number($connect,$_SESSION['student_id'])?></h4>
                                        
                                    </div>                                
                            </div>        
                            <pre></pre>
                            <div class="mon_slider">
                            <div class="retard">
                                        <h3 style="font-size: 19px;font-weight:400;">Presence(s)</h3>
                                        <hr>
                                        <div class="courses_retard">
                                            <h4 style="font-weight:400;"><?=get_presence_number($connect,$_SESSION['student_id'])?></h4>
                                        </div>
                            </div>
                            <div class="retard">
                                        <h3 style="font-size: 19px;font-weight:400;">Absence(s)</h3>
                                        <hr>
                                        <div class="courses_retard">
                                            <h4 style="font-weight:400;"><?=get_absence_number($connect,$_SESSION['student_id'])?></h4>
                                        </div>
                            </div>
                            </div>
                            <pre></pre>
                          

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="slider">
                            <div class="slick_car">
                                <canvas id="myChart3" width="1000" height="1200"></canvas>                        
                            </div>

                            <div class="slick_car">
                                Statistique en % sur 20 absences
                            <?php $i=0;
                            foreach($ma_requeteA as $load_cours){
                                $courses_load=$load_cours['nom_matiere'];
                                $query_courses_load=$connect->prepare("SELECT * FROM 
                                tbl_attendance WHERE matiere_id=? AND 
                                student_id=? AND attendance_status=?");
                                $query_courses_load->execute(array($load_cours['id_matiere'],$_SESSION['student_id'],$statusA));
                                $pourcentage=(string)(($query_courses_load->rowCount()*100)/20).'%';            
                                ?>
                                <div class="skillbar clearfix " data-percent="<?=$pourcentage?>">
                                    <div class="skillbar-title" style="background:<?=$color_list[$i]?>"><span><?=ucfirst($load_cours['nom_matiere'])?></span></div>
                                    <div class="skillbar-bar" style="background:<?=$color_list[$i]?>"></div>
                                    <div class="skill-bar-percent"><?=($query_courses_load->rowCount()*100)/20?></div>
                                </div> <!-- End Skill Bar -->
                            <?php
                            $i++;
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <pre></pre>
            <div class="row">
                <div class="col-md-6">
                    <div class="others__courses">
                       <center><h4>Cours Recemment ajoutées</h4></center>
                        <hr>
                        <?php include('pages/recently_add.php')?>
                        <a href="listecours.php?coursdetails=<?=Get_student_grade_id($connect,$_SESSION['student_id'])?>" id="link_courses">Voir tous les cours</a>
                    </div>                
                </div>
                <div class="col-md-6">
                    <div class="teacher__courses">
                        <center><h4>Details Absences</h4></center>

                        <hr>
                        
                        <table id="monTableau">
                                <thead>
                                    <tr class="notThis">
                                        <th>Cours</th>
                                        <th>Status</th>
                                        <th>Professeur</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>        
                                <tbody>
                                <?php foreach($attendance_fetch as $row_list){
                                        ?>
                                        <tr>
                                            <td><?=ucfirst($row_list['nom_matiere'])?></td>
                                            <?php if($row_list['attendance_status']=='Present'){
                                            ?>
                                            <td style="color:#32CD32;font-weight:bold;"><?=ucfirst($row_list['attendance_status'])?></td>
                                            <?php                                                
                                            }else{
                                            ?>    
                                            <td style="color:#B22222;font-weight:bold;"><?=ucfirst($row_list['attendance_status'])?></td>
                                            <?php
                                            }
                                            ?>

                                            <td><?=ucfirst($row_list['teacher_name'])?></td>
                                            <td><?=ucfirst($row_list['attendance_date'])?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                
                        </table>
                        <a style="position: absolute;right:0;" href="attendance.php">Voir plus</a>
                        <!--DETAILS LISTE DES PROFESSEURS-->
                    
                        

                    </div>
                </div>
            </div>


            
            
        </div>
    </div>
    


</div>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="public/js/student/profile_student_action.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<?php include('pages/chart.php')?>
<?php include('pages/skill.php')?>
</body>
</html>
