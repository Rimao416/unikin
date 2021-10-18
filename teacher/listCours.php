<?php
include('header.php');
$request=$connect->prepare("SELECT * FROM tbl_section WHERE section_id=?");
$request->execute(array($_GET['id']));
$myFetch=$request->fetch();
$prof=$myFetch['id_prof'];
if($myFetch['id_prof']!=$_SESSION['teacher_id']){
    ?>
        <section style="background-color: white;">
                <img src="../admin/images/error.png" alt="" style="width:50%;">
                <center><h3>Desolé, vous n'êtes pas autorisé à voir ce cours</h3></center>
        </section>




    <?php

}else{
    $request2=$connect->prepare("SELECT * FROM tbl_cours WHERE id_section=?");
    $request2->execute(array($_GET['id']));
    $myFetch2=$request2->fetchAll();
    $retour='';
    $nombre=$request2->rowCount();
?>
          <section id="blur">
            <div class="container__card">
                 <div class="header___container">
                     <div class="course_name">
                         <h3 style="font-family:poppins;font-weight:400;font-size:17px;color:#6923D0;">Accueil / <a  href="cours.php" style="color:rgb(88,97,105);">Cours</a>/ <a  href="cours.php" style="color:rgb(88,97,105);"></a> <span><?=$myFetch['section_name']?></span> </h3>
                     </div>
                     <div class="bouton">
                         <button style="cursor:pointer;" onclick="toggle()">Ajoutez un élément</button>
                     </div>
                 </div>

                </div>
 
                <div class="container-fluid">
        <div class="row" id="SectionCours">
            <div class="col-md-8" >
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
                                <a href="../public/Document/<?=$row['cours_content']?>" download><?= return_image($row['cours_content'])?></a>        
                            </div>
                            <div class="content__text">
                                <h4> <?= substr($row['text_cours'],0,200)?></h4>
                                <h5 ><?=$row['cours_date']?></h5>
                            </div>
                            <div class="content__modify">
                                <i class='bx bx-edit-alt' id="Index" data-iduser="<?=$row['id_cours']?>"></i>
                                <pre> </pre>
                                <div id="popup_action" class="ClasseUtilisable<?=$row['id_cours']?>">
                                    <div>
                                        <h6 class="modification" data-modifier="<?=$row['id_cours']?>">Modifier</h6>
                                    </div>
                                    <hr>
                                    <div>
                                        <h6 class="suppression" data-supprimer="<?=$row['id_cours']?>">Supprimer</h6>
                                    </div>
                                </div>
                            </div>   
                            </div>
                        <?php
                        }
                            ?>


                    </div>
                </div>
            </div>
            <div class="col-md-4">

                <div class="lessons__information">
                    <div class="about__teacher">
                        <div class="image__content">
                           <center><img src="../public/teacher_image/<?=get_all($connect,'tbl_teacher','teacher_id',$_SESSION['teacher_id'],'teacher_image')?>" alt="" style="text-align: center;"></center> 
                            <h4 style="text-align: center;font-size: 20px;"><?=ucfirst(get_all($connect,'tbl_teacher','teacher_id',$_SESSION['teacher_id'],'teacher_name'))?></h4>
                        </div>
                        <hr>
                        <div class="portofolio">
                            <h4 class="Contenu" style="text-align:center;"> JE SUIS PROFESSEUR AU SEIN DE L'UNIVERSITE</h4>
                        </div>
                        <hr>
                    </div>
                    <div class="about__courses">
                        <h4 class="number"><?=$nombre?></h4>
                        <h4>Cours Deposés</h4>
                        <hr>
                    </div>
                </div>
            </div>
        
            
        </div>
    </div>


             </section>

             <script src="../admin/js/toogle.js"></script>
         <script>
             $(function(){
                $("form").on("change", ".file-upload-field", function(){
                  $(this).parent(".file-upload-wrapper").attr("data-text",$(this).val().replace(/.*(\/|\\)/,''));
                })

                $('#ElementForm').on('submit',function(event){
                event.preventDefault();
                var SectionEntry=$('#ElementEntry').val()
                if(SectionEntry == ''){
                    $('#response').html('<span class="text-danger">Tous les champs se doivent d\'etre rempli</span>');
                }else{
                    $.ajax({
                    url:'../include/teacher/listcours_actions.php',
                    method:'POST',
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    beforeSend:function(){
                        $('#response').html('<span class="text-info">En attente...</span>')
                        $('#response').attr('disabled','disabled')
                    },
                    success:function(data){
                        var response=data;
                        $('#response').html('<span class="text-success ">'+response+'</span>')
                        $('#response').attr('disabled',false)                        
                        
                        if(response=="reussi"){
                            setInterval(() => {
                            location.reload()
                        },150);
                        }                               
                        }
                })
                }
            })
             })

         </script>
         <script>
            function toggle(){

                var blur=document.getElementById('blur');
                blur.classList.toggle('active')
                var login=document.getElementById('login');
                login.classList.toggle('active')
            }
         </script>
         <script src="../public/js/teacher/teacher_toggle_js.js"></script>
         <?php
}
?>

  

</body>
</html>
<!--LOGIN-->
<div id="login">
                    <h4 onclick="toggle()" id="close">X</h4>
                    <div id="connexion-page">
                        <h3 style="color:rgb(72,72,72);text-align:center;" class="Titre">Ajout d'un élément</h3>
                        <hr style="color:rgba(72,72,72,.4)">
                        <div id="response"></div>
                        <form action=""  class="formulaireAjout" enctype="multipart/form-data" method="post"  name="ElementForm" id="ElementForm">
                            <input type="text" placeholder="Entrez le nom de l'élément" id="ElementEntry" name="ElementEntry" class="form-control">
                            <input type="hidden" value="" id="ElementId" name="ElementId">
                            <input type="hidden" value="<?=$_GET['id']?>" name="identifiant" id="identifiant">
                            <pre>
                            
                            </pre>
                            <div class="file-upload-wrapper" data-text="Select your file!">
                                <input name="file-upload-field" id="file-upload-field" type="file" class="file-upload-field" value="">
                            </div>
                            <input type="hidden" name="action" id="action" value="Add" />
                            <button type="submit" id="submitSend" class="btn btn-success">Créer</button>
                        </form>
                    </div>
                    
             </div>
<!--FIN-->

