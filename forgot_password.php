<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page de Connexion</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="styl.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
</head>
<body>
<div class="sidenav">
      
        <div class="main_recovery" id="create_link">
                <form method="post" id="student_account_form">
                  <div class="title">
                        <h3>Récuperation du Compte</h3>
                        <hr>
                        <hr>
                  </div>
                   <div class="information">
                   <h6>Pour recevoir les informations concernant votre addresse de connexion, veuillez indiquer ci-dessous 
                     votre adresse de courriel. <br> <br>
                      Si les données correspondantes
                      se trouvent dans la base de données, un message vous sera envoyé par courriel, 
                     avec des instructions vous permettant de vous connecter.</h6>
                   </div>  
                   <br>
                  <div class="form-group">
                     <label>Addresse De Connexion</label>
                     <input type="text" name="student_recovery" id="student_recovery" class="form-control">
                     <input type="hidden" value="envoyer" name="action">
                     <span id="error_student_recovery" class="text-danger"></span>
                    
                  </div>

                  <input type="submit" name="student_recov" id="student_recov" class="btn btn-info" value="Confirmer">
               </form>
        </div>

      </div>
</div>
<script>
    function isEmail(email) {
     var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
        }
</script>
<script src="public/js/student/student_forgot.js"></script>
</body>
</html>