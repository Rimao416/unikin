<?php
include('header.php');

$ma_requete=$connect->prepare("SELECT * FROM tbl_section WHERE id_prof=? AND id_matiere=?");
$ma_requete->execute(array($_SESSION['teacher_id'],$_SESSION['matiere']));
$nombre=$ma_requete->rowCount();
$color_list=['#0000FF','#8A2BE2','#A52A2A','#DEB887','#D2691E','#6495ED','#FF7F50','#DC143C',
    '#00008B','#B8860B','#006400','#8B008B'];    
?>
            <section id="blur">
            <div class="container__card">
                 <div class="header___container">
<!--                     <div class="course_name">
                         <h3 style="font-family:poppins;font-weight:400;font-size:17px;color:#6923D0;">Accueil / <a  href="cours.php" style="color:rgb(88,97,105);">Cours</a></h3>
                     </div>-->
                     <div class="bouton">
                         <button onclick="toggle()"  style="cursor:pointer;">Ajouter Section</button>
                     </div>
                 </div>

                <?php if($nombre==0){
                    ?>
                        <div class="container__card">
                            <div class="card__text">
                                <img src="img/cry.png" width="800" style="margin-left:10%;"alt="">
                            </div>
                <?php
                    }else{
                        $liste_cours=$ma_requete->fetchAll();
                        $i=0;
                        foreach($liste_cours as $row){  
                            
                            ?>
                        <a href="listCours.php?id=<?=$row['section_id']?>" style="color:rgb(72,72,72);">
                        <div class="card__user">
                            <div class="content__card">
                                <div class="card__img" style="background-color:<?=$color_list[$i];?>">
                                    <h2><?= explode_this($row['section_name'])?></h2>
                                    </div>
                                <div class="card__text">
                                <?=$row['section_name']?>
                                </div>
                            </div>
                            
                        </div>
                        </a>
                        <?php 
                         $i+=1;
                        }
                        ?>


                <?php
                    }
                    ?>
                </div>
 
             </section>
             <div id="login">
                    <h4 onclick="toggle()" id="close">X</h4>
                    <div id="connexion-page">
                        <h3 style="color:rgb(72,72,72);text-align:center;">Section d'Ajout</h3>
                        <hr style="color:rgba(72,72,72,.4)">
                        <div id="response"></div>
                        <form action="" method="post" id="SectionForm">
                            <input type="text" placeholder="Entrez le nom de la Section" id="SectionEntry" name="SectionEntry" class="form-control">
                            <pre>

                            </pre>
                            <button type="submit" id="submitSend" class="btn btn-success">Créer</button>
                        </form>
                    </div>
                    
             </div>
 
         <!--========== MAIN JS ==========-->
         <script src="../admin/js/toogle.js"></script>
         <script>
             $(function(){
                $('#SectionForm').on('submit',function(event){
                event.preventDefault();
                var SectionEntry=$('#SectionEntry').val()
                if(SectionEntry == ''){
                    $('#response').html('<span class="text-danger">Tous les champs se doivent d\'etre rempli</span>');
                }else{
                    $.ajax({
                    url:'../include/teacher/cours_action.php',
                    method:'POST',
                    data:$(this).serialize(),
                    beforeSend:function(){
                        $('#response').html('<span class="text-info">En attente...</span>')
                        $('#response').attr('disabled','disabled')
                    },
                    success:function(data){
                        
                        $('#response').html('<span class="text-success ">Réussie...</span>')
                        $('#response').attr('disabled',false)
                        setInterval(() => {
                            location.reload()
                        },150);
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
         </html>
