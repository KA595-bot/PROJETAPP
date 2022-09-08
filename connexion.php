<?php
session_start();
require 'database.php';
if(isset($_POST['formconnect'])){
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);
     if(!empty($mailconnect) && !empty($mdpconnect)){
           $requser = $dbd->prepare("SELECT * FROM administrateur WHERE email= ? AND mdp= ?");
           $requser->execute(array($mailconnect, $mdpconnect));
           $userexist = $requser->rowCount();
           if($userexist == 1){
                $userinfo = $requser->fetch();
                $_SESSION['id'] = $userinfo['id'];
                $_SESSION['pseudo'] = $userinfo['pseudo'];
                $_SESSION['mail'] = $userinfo['mail'];
                header('Location: dashboard.php?id='.$_SESSION['id']);
           }else{
            $erreur = "Mauvais email ou mot de passe !!";
           }
     }else{
      $erreur = "Tous les champs doivent etre remplis";
     }
}

 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vendor/css/bootstrap.min.css">
    <script src="vendor/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-te-1.4.0.min.js"></script>
    <link rel="stylesheet" href="connexion.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
    <script src="vendor/fontawesome/js/all.min.js"></script>
    <title>Connexion</title>
</head>
<body>
 
  <div class="container">
      <div class="row content">
      <?php
               if(isset($erreur)){
                  ?>
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                     <strong><?= $erreur;  ?></strong>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <?php
                 
               }

            ?>
         <div class="col-md-6 mb-3">
            <img src="images/admin2.jpg" class="img-fluid"alt="image"style="height:120%;">
         </div>
         <div class="col-md-6">
            <h3 class="signin-text mb-3">Connexion</h3>

            <form action="#" method="POST">
               <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="mailconnect" id="mailconnect"class="form-control"value="<?php if(isset($mailconnect)){ echo $mailconnect; }  ?>">
               </div>
               <div class="form-group">
                  <label for="password">Mot de passe</label>
                  <input type="password" name="mdpconnect" id="mdpconnect"class="form-control"value="<?php if(isset($mdpconnect)){ echo $mdpconnect; }  ?>">
               </div>
               <button class="btn btn-class"name="formconnect"type="submit">Connexion</button> <buttton class="btn btn-success"> <a href="accueil.php" class="text-decoration-none text-white">Retour </a></buttton><br>
             
            </form>
         </div>
      </div>
  </div>
    
</body>
</html>