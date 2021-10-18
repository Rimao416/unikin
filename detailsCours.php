<?php
    include('header.php');
    if(!isset($_GET['Cours_action']) || ($_GET['Cours_action']=='')){
        echo "<script>location.href='error.php'</script>";
    }
    $request=$connect->prepare("SELECT * FROM tbl_section WHERE section_id=?");
    $request->execute(array($_GET['Cours_action']));
    $myFetch=$request->fetch();
    //
    $request2=$connect->prepare("SELECT * FROM tbl_cours WHERE id_section=?");
    $request2->execute(array($_GET['Cours_action']));
    $myFetch2=$request2->fetchAll();



?>

<section>
            <div class="container__card">
                 <div class="header___container">
                     <div class="course_name">
                     <h3 style="font-family:poppins;font-weight:400;font-size:17px;color:#6923D0;">Accueil / <a  href="index.php" style="color:rgb(88,97,105);">Cours</a>/ <a  href="profile.php" style="color:rgb(88,97,105);">Profile</a> / <a  href="cours.php" style="color:rgb(88,97,105);"></a> <span><?=$myFetch['section_name']?></span> </h3>
                     </div>
                 </div>

            </div>
 
                <div class="container-fluid">
        <div class="row" id="SectionCours">
            <div class="col-lg-12" >
                <div class="lessons__container">
                    <div class="courses__posed">
                        <div class="lessons_title">
                            <h2>Lessons</h2>
                            <hr> 
                        </div>

                        <?php foreach($myFetch2 as $row){
                            ?>
                        <div class="lessons__content">
                            <div class="content__icons">
                                <a href="Document/<?=$row['cours_content']?>" download><?= return_image($row['cours_content'])?></a>        
                            </div>
                            <div class="content__text">
                                <h4> <?= substr($row['text_cours'],0,200)?></h4>
                                <h5 ><?=$row['cours_date']?></h5>
                            </div>
                            </div>
                        <?php
                        }
                            ?>


                    </div>
                </div>
            </div>
        </div>
    </div>


    </section>


</body>
</html>