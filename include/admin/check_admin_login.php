<?php
    include('../database_connection.php');
    session_start();
    $admin_user_name='';
    $admin_password='';
    $error_admin_user_name='';
    $error_admin_password='';
    $error=0;
    if(empty($_POST["admin_user_name"])){
        $error_admin_user_name='Username is required';
    }
    else{
        $admin_user_name=trim($_POST["admin_user_name"]);
    }
    if(empty($_POST["admin_password"])){
        $error_admin_password='Password is required';
        $error++;
    }else{
        $admin_password=trim($_POST["admin_password"]);
    }
    if($error==0){
        $query="SELECT * FROM table_admin WHERE user ='".$admin_user_name."'
        ";
        $statement=$connect->prepare($query);
        if($statement->execute()){
            $total_row=$statement->rowCount();
            if($total_row > 0){
                $result=$statement->fetchAll();
                foreach($result as $row){
                   if(password_verify($admin_password,$row["password"])){
                        $_SESSION["admin_id"]=$row["id_admin"];
                    }else{
                        $error_admin_password="WRONG PASSWORD";
                        $error++;
                    }
                }
            }
        else{
            $error_admin_user_name='WRONG USERNAME';
            $error++;
        } 
        }
    }
    if($error > 0){
        $output=array(
            'error'=>true,
            'error_admin_user_name'=>$error_admin_user_name,
            'error_admin_password'=>$error_admin_password
        );

    }else{
        $output=array('success'=>true);
    }
    echo json_encode($output);
?>