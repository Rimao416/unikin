<?php
    include('../database_connection.php');
    if(isset($_POST['SectionEntry'])){
        $query=$connect->prepare('INSERT INTO faculte (section_name) VALUES (?)');
        $query->execute(array($_POST['SectionEntry']));
        echo 'Reussi';
    }
?>