<?php
    session_start();
    $connect=new PDO("mysql:host=localhost;dbname=unikin","root","");
    if(isset($_POST['SectionEntry'])){
        $query=$connect->prepare('INSERT INTO tbl_section (section_name,id_prof,id_matiere) VALUES (?,?,?)');
        $query->execute(array($_POST['SectionEntry'],$_SESSION['teacher_id'],$_SESSION['matiere']));
        echo 'data';
    }
?>