<?php
    include('../database_connection.php');
    session_start();
    $output='<div class="content__toggle">';
    if($_POST['action']=='load_courses'){
        $query_courses=$connect->prepare("SELECT * FROM tbl_cours WHERE id_section=?");
        $query_courses->execute(array($_POST['attribute']));
        $query_fetch=$query_courses->fetchAll();
        $nombre_query=$query_courses->rowCount();
        if($nombre_query==0){
            $output="Aucun cours n'a encore été deposé dans ce livre";
        }else{
        foreach($query_fetch as $row){
            $output .='
            <div class="text">

            <a href="public/Document/'.$row["cours_content"].'" download>'.return_image2($row["cours_content"]).'</a>
            <h4 style="font-style: 12px;font-weight: 500;color:rgb(176,176,176)">'.$row["text_cours"].'</h4>
            </div>';
        }
    }
    }
    $output .='</div>';
    echo $output;
?>