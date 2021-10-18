<?php
    include('include/student/header.php');
    $attendance_query=$connect->prepare("SELECT * FROM tbl_attendance 
    INNER JOIN tbl_student 
    ON tbl_student.student_id=tbl_attendance.student_id
    INNER JOIN tbl_teacher 
    ON tbl_teacher.teacher_id=tbl_attendance.teacher_id
    INNER JOIN tbl_matiere 
    ON tbl_matiere.id_matiere=tbl_attendance.matiere_id
    WHERE tbl_student.student_id=? ORDER BY tbl_attendance.attendance_id");
    $attendance_query->execute(array($_SESSION['student_id']));
    $attendance_fetch=$attendance_query->fetchAll();
?>
<div class="header___container">
    <div class="course_name">
            <h3 style="font-family:poppins;font-weight:400;font-size:17px;color:#6923D0;">Accueil / <a  href="index.php" style="color:rgb(88,97,105);">Cours</a>/ <a  href="profile.php" style="color:rgb(88,97,105);">Profile</a> / <a  href="cours.php" style="color:rgb(88,97,105);"></a> <span>Details</span> </h3>
    </div>
</div>
<div class="col-lg-12">
                          <table id="monTableau" style="width:100%;height:100vh;">
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
                        </div> 

</body>
</html>