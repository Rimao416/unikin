<?php
    include('include/database_connection.php');
    session_start();
/*    if(isset($_SESSION["matiere"])){
        header('location:index.php');
    }*/
    if(isset($_SESSION["student_id"])){
        header('location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page de Connexion</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="public/css/student/styl.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
</head>
<body>
<div id="container">
</div>
<div id="container2"></div>
<div class="sidenav">
      
        <div class="main">
                <form method="post" id="student_login_form">
                  <div class="title">
                        <h3>Page de Connexion</h3>
                        <hr>
                        <hr>
                  </div>
                  <div class="form-group">  
                     <label>Adresse de Connexion</label>
                        <input type="text" name="student_emailid" id="student_emailid" class="form-control">
                        <span id="error_student_emailid" class="text-danger"></span>
                  </div>
                  <div class="form-group">
                     <label>Mot de passe</label>
                     <input type="password" name="student_password" id="student_password" class="form-control">
                     <span id="error_student_password" class="text-danger"></span>
                  </div>
                  <input type="submit" name="student_login" id="student_login" class="btn btn-info" value="Connexion">
               </form>
               <a href="forgot_password.php" id="Forgot">Coordonnées Oubliées</a>
        </div>

      </div>
</div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="public/js/student/student_log.js"></script>
</body>
</html>
