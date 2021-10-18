<?php
    $allowed_extension = array('doc','docx','xls','xlxs','7z','arj','deb','pkg','rar','rpm','tar.gz','z','zip','pdf');
    $date=date("Y-m-d").' '.date("H:i:s",STRTOTIME(date('h:i:sa')));
    session_start();
    $connect=new PDO("mysql:host=localhost;dbname=unikin","root","");
    if(isset($_POST['ElementEntry'])&&($_POST['action']=='Add')){
        $file_name = $_FILES["file-upload-field"]["name"];
        $tmp_name = $_FILES["file-upload-field"]['tmp_name'];
        $extension_array = explode(".", $file_name);
        $extension = strtolower($extension_array[1]);
        $allowed_extension = array('doc','docx','xls','xlxs','7z','arj','ppt','pptx','deb','pkg','rar','rpm','tar.gz','z','zip','pdf');
        if(!in_array($extension,$allowed_extension)){
            echo "Vous devez choisir le bon format (docx,doc,7z,rar,pdf,ppt,xls,ppt,pptx";
        }else{
         $name_file = uniqid(). '.' . $extension;
         $upload_path = "../../public/Document/".$name_file;    
         move_uploaded_file($tmp_name, $upload_path);
        $query=$connect->prepare('INSERT INTO tbl_cours (text_cours,cours_content,id_section,cours_date) VALUES (?,?,?,?)');
        $query->execute(array($_POST['ElementEntry'],$name_file,$_POST['identifiant'],$date));
        echo "reussi";
    }
    }elseif(isset($_POST['ElementEntry'])&&($_POST['action']=='Edit')){ 
        $file_name = $_FILES["file-upload-field"]["name"];
        $tmp_name = $_FILES["file-upload-field"]['tmp_name'];
        $extension_array = explode(".", $file_name);
        $extension = strtolower($extension_array[1]);
        $identifiant=$_POST['ElementId'];
 //       $allowed_extension = array('jpg','png');
         $name_file = uniqid(). '.' . $extension;
         $upload_path = "../../public/Document/".$name_file;    
         move_uploaded_file($tmp_name, $upload_path);
        $query=$connect->prepare('UPDATE tbl_cours SET text_cours=?, cours_content=?,cours_date=? WHERE id_cours=?');
        $query->execute(array($_POST['ElementEntry'],$name_file,$date,$identifiant));
        echo "reussi";
        
    }elseif(isset($_POST['supprimer'])&&($_POST['action']=='supprimer')){
        $valeur=$_POST['supprimer'];
        $query=$connect->prepare('DELETE FROM tbl_cours WHERE id_cours=?');
        $query->execute(array($valeur));

    }


?>