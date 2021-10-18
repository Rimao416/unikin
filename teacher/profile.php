<?php
    include('header.php');
    $color_list=['rgba(0,0,255,0.6)','rgba(138,43,226,.6)','rgba(165,42,42,.6)','rgba(222,184,135,.6)','rgba(95,158,160,.6)','rgba(210,105,30,.6)','rgba(0,0,139,.6)','rgba(139,0,139,.6)','rgba(153,50,204,.6)','rgba(72,61,139,.6)',
    'rgba(75,0,130,.6)','rgba(128,128,0,.6)'];
    $color_list2=['rgb(0,0,255)','rgb(138,43,226)','rgb(165,42,42)','rgb(222,184,135)','rgb(95,158,160)','rgb(210,105,30)','rgb(0,0,139)','rgb(139,0,139)','rgb(153,50,204)','rgb(72,61,139)','rgb(75,0,130)',
    'rgb(128,128,0)'];
    $recent_courses=$connect->prepare("SELECT * FROM tbl_matiere 
    INNER JOIN tbl_section ON tbl_section.id_matiere=tbl_matiere.id_matiere
    INNER JOIN tbl_teacher ON tbl_teacher.teacher_id=tbl_matiere.id_prof
    
    WHERE tbl_matiere.id_matiere=? AND tbl_teacher.teacher_id=?");
    $recent_courses->execute(array($_SESSION['matiere'],$_SESSION['teacher_id']));

?>

<div class="container">
<!--Teacher_up.php-->
<?php include("../pages/teacher/teacher_up.php")?>
  <div class="col-lg-12">
  
    <?php include("../pages/teacher/teacher_down.php")?>
    <div class="login__teacher">
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js"></script>
<script>
  var typed=new Typed('.typed',{
    strings:[
      "est le labourage des intelligences, mais toute terre ne donne pas une riche végétation.",
      "obligatoire semble miner la volonté personnelle d'apprendre.",
      "de l'araignée n'est pas pour la mouche.",
      ",c'est une amitié.",
      " : apprendre à savoir, à savoir faire, à faire savoir. L'éducation : apprendre à savoir être.",
      " perpétue la mémoire du monde et lui redonne quotidiennement son sens, une parcelle de sens."
    ],
    typeSpeed:50,
    backSpeed:20,
    loop:true
  })
  $(document).on('click','.content__text',function(){
            var id_teacher=$(this).data('teacher')
            location.href="listCours.php?id="+id_teacher;
})
</script>
<script src="../public/js/teacher/teacher_modify_profile.js"></script>
<script src="../public/js/teacher/teacher_change_passwordd.js"></script>
</body>
</html>