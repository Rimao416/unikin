<?php include('../include/admin/header.php');

$ma_requete=$connect->prepare("SELECT * FROM faculte");
$ma_requete->execute();
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
                        <a href="departement.php?id=<?=$row['id']?>" style="color:rgb(72,72,72);">
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
                            <input type="text" placeholder="Entrez le nom de la Faculté" id="SectionEntry" name="SectionEntry" class="form-control">
                            <pre>

                            </pre>
                            <button type="submit" id="submitSend" class="btn btn-success">Créer</button>
                        </form>
                    </div>
                    
             </div>
 
         <!--========== MAIN JS ==========-->
         <script src="../admin/js/toogle.js"></script>
         <script src="../public/js/admin/fac_traitement.js">
           
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


<script>
	


$(document).ready(function(){
  
})
</script>
