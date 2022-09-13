<?php
require 'database.php';

if(isset($_POST['inscription'])){
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $email2 = htmlspecialchars($_POST['email2']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);

    if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['email2']) && !empty($_POST['mdp'] && !empty($_POST['mdp2']))){
    
          $pseudolength = strlen($pseudo);
          if($pseudolength <= 15){
              if($email == $email2){
                if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])){
                    $reqmail = $dbd->prepare("SELECT * FROM administrateur WHERE email= ?");
                    $reqmail->execute(array($email));
                    $mailexist = $reqmail->rowCount();
                       if($mailexist == 0){
                            if($mdp == $mdp2){
                                $insertmbr = $dbd->prepare("INSERT INTO administrateur(pseudo,email,mdp) VALUES (?, ?, ?)");
                                $insertmbr->execute(array($pseudo, $email, $mdp));
                                $erreur = "votre compte a bien ete cree <a href=\"connexion.php\"class='text-decoration-none text-info'>Me connecter</a>";
                            }else{
                                $erreur = "Vos mot de passes ne correspondent pas!";
                            }
                       }else{
                        $erreur = "Adresse mail deja utilisee...";
                       }
                    }else{
                        $erreur = "Votre adresse mail est invalide";
                    }    
              }else{
                $erreur = "Vos adresses mail ne correspondent pas";
              }
          }else{
            $erreur = "votre pseudo ne doit pas depasser 15 caracteres";
          }
    }else{
        $erreur  = "Tous les champs doivent etre remplis";
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
    <title>Ajouter_administrateur</title>
</head>
<body>
 
  <div class="container-fluid">
      <div class="row content mt-4">
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
         <div class="col-md-6 mb-6">
            <img src="images/admin2.jpg" class="img-fluid"alt="image"style="height: 100%;">
         </div>
         <div class="col-md-6">
            <h3 class="signin-text mb-3">Ajouter un Administrateur</h3>

            <form action="#" method="POST">
            <div class="form-group">
                  <label for="pseudo">Pseudo</label>
                  <input type="text" name="pseudo" id="email"class="form-control"value="<?php if(isset($email)){ echo $pseudo; }  ?>">
               </div>
               <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email"class="form-control"value="<?php if(isset($email)){ echo $email; }  ?>">
               </div>
               <div class="form-group">
                  <label for="emai2">Confirmer L'email</label>
                  <input type="email" name="email2" id="email2"class="form-control"value="<?php if(isset($email)){ echo $email2; }  ?>">
               </div>
               <div class="form-group">
                  <label for="password">Mot de passe</label>
                  <input type="password" name="mdp" id="mdp"class="form-control"value="<?php if(isset($password)){ echo $mdp; }  ?>">
               </div>
               <div class="form-group">
                  <label for="password">Confirmer le mot de passe</label>
                  <input type="password" name="mdp2" id="mdp2"class="form-control"value="<?php if(isset($password)){ echo $mdp2; }  ?>">
               </div>
               <button class="btn btn-class"name="inscription"type="submit">Ajouter</button> <buttton class="btn btn-success"> <a href="connexion.php" class="text-decoration-none text-white">Retour </a></buttton><br>
             
            </form>
         </div>
      </div>
  </div>
    
</body>
</html>