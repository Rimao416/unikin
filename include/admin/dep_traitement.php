<?php
    include('../database_connection.php');
    if(isset($_POST['SectionEntry'])){
        $query=$connect->prepare('INSERT INTO departement (nom_dep,faculte) VALUES (?,?)');
        $query->execute(array($_POST['SectionEntry'],$_POST['id']));
    }
?>