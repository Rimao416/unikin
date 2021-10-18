<?php
    include('../include/database_connection.php');
    session_start();
    if(isset($_SESSION["matiere"])){
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
        <link rel="stylesheet" href="../public/css/teacher/style_teacher.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
</head>
<body>
<div id="container">
</div>
<div id="container2"></div>
<div class="sidenav">
      
        <div class="main">
                <form method="post" id="teacher_login_form">
                  <div class="title">
                        <h3>Page de Connexion</h3>
                        <hr>
                        <hr>
                  </div>
                  <div class="form-group">  
                     <label>Adresse Mail</label>
                        <input type="text" name="teacher_emailid" id="teacher_emailid" class="form-control">
                        <span id="error_teacher_emailid" class="text-danger"></span>
                  </div>
                  <div class="form-group">
                     <label>Mot de passe</label>
                     <input type="password" name="teacher_password" id="teacher_password" class="form-control">
                     <span id="error_teacher_password" class="text-danger"></span>
                  </div>
                  <input type="submit" name="teacher_login" id="teacher_login" class="btn btn-info" value="Connexion">
               </form>
               <a href="recoveryPassword.php" id="Forgot">Mot de passe Oublié</a>
        </div>

      </div>
</div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="../public/js/teacher/teacher_login.js"></script>
</body>
</html>
