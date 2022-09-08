<?php
session_start();
require 'database.php';

   if(isset($_SESSION['id'])){
    $requser = $dbd->prepare("SELECT * FROM administrateur WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    if(isset($_POST['newpseudo']) && !empty($_POST['newpseudo']) && $_POST['newpseudo'] != $user['pseudo']){
        $newpseudo = htmlspecialchars($_POST['newpseudo']);
        $insertpseudo = $dbd->prepare("UPDATE administrateur SET pseudo = ? WHERE id = ?");
        $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
        header('Location: dashboard.php?id='.$_SESSION['id']);
    }

        if(isset($_POST['newmail']) && !empty($_POST['newmail']) && $_POST['newmail'] != $user['email']){
            $newmail = htmlspecialchars($_POST['newmail']);
            $insertmail = $dbd->prepare("UPDATE administrateur SET email = ? WHERE id = ?");
            $insertmail->execute(array($newmail, $_SESSION['id']));
            header('Location: dashboard.php?id='.$_SESSION['id']);
        }

        if(isset($_POST['newmdp1']) && !empty($_POST['newmdp2']) && isset($_POST['newmdp2']) && !empty($_POST['newmdp2'])){
            $newmdp1 = sha1($_POST['newmdp1']);
            $newmdp2 = sha1($_POST['newmdp2']);
                if($newmdp1 == $newmdp2){
                $insertmdp = $dbd->prepare("UPDATE administrateur SET mdp = ? WHERE id = ?");
                $insertmdp->execute(array($newmdp1, $_SESSION['id']));
                header('Location: dashboard.php?id='.$_SESSION['id']);
        }else{
            $msg = "les mots de passes doivent etre identiques!!";
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
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="connexion.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
    <script src="vendor/fontawesome/js/all.min.js"></script>
    <script src="jquery.js"></script>
    <title>Editer profil</title>
</head>
<body>
   <div class="vertical-nav bg-white" id="sidebar">
       <div class="py-4 px-3 mb-4 bg-light">
           <div class="media d-flex align-items-center">
              <img src="images/CFPCanadienne.png" alt=""style="width: 120px;">
              <div class="media-body">
                  <h4 class="mx-3">APP</h4>
                  <P class="font-weight-normal text-muted mb-0 mx-3">Gestion Paie Scolarite(GPS)</P>
              </div>
           </div>
       </div>

       <P class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0 fw-bold">Etudiants</P>

       <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
            <a href="connexion.php" class="nav-link text-dark bg-light">
                <i class="fa fa-tachometer mr-3 text-primary fa-fw"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <li class="active">
                <a href="#" data-bs-toggle="collapse"  data-bs-target="#homeSubmenu" aria-expanded="false" class="dropdown-toggle nav-link text-dark">
                    <i class="fa-sharp fa-solid fa-folder-open mr-3 text-primary fa-fw"></i> Filieres</a>
                <ul class="collapse list-unstyled mx-3" id="homeSubmenu">
                    <li>
                        <a href="#"class="text-decoration-none">Gestion</a>
                    </li>
                    <li>
                        <a href="#"class="text-decoration-none">Agriculture et elevages</a>
                    </li>
                    <li>
                        <a href="#"class="text-decoration-none">Genie informatique</a>
                    </li>
                    <li>
                        <a href="#"class="text-decoration-none">Arts et metiers de la culture</a>
                    </li>
                    <li>
                        <a href="#"class="text-decoration-none">Genie civil</a>
                    </li>
                    <li>
                        <a href="#"class="text-decoration-none">Commerce-Vente</a>
                    </li>
                    <li>
                        <a href="#"class="text-decoration-none">Sante</a>
                    </li>
                </ul>
            </li>
        </li>
       <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0 fw-bold">Administrateur</p>
        
        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="#" class="nav-link text-dark">
                    <i class="fa-solid fa-user-pen mr-3 text-primary fa-fw"></i>
                    Editer profile
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark">
                    <i class="fa-sharp fa-solid fa-address-card mr-3 text-primary fa-fw"></i>
                    Modifier
                </a>
            </li>
            <li class="nav-item">
                <a href="ajouter-admin.php" class="nav-link text-dark">
                    <i class="fa-sharp fa-solid fa-arrow-up-from-bracket mr-3 text-primary fa-fw"></i>
                    Ajouter Admin
                </a>
            </li>
            <hr class="hr-line">
            <li class="nav-item">
                <a href="deconnexion.php" class="nav-link text-danger">
                    <i class="fa-sharp fa-solid fa-right-from-bracket mr-3 text-primary fa-fw"></i>
                    Logout
                </a>
            </li>
        </ul>

   </div>  
   <!-- page content -->
   <div class="page-content p-5"id="content">
        
        <button id="sidebarCollapse"type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4">
            <i class="fa fa-bars mr-2"></i><small class="text-uppercase fw-bold mx-2">Menu</small>
        </button>
        
        <div class="container bg-light">
      <div class="row content">
      <?php
               if(isset($msg)){
                  ?>
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                     <strong><?= $msg;  ?></strong>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <?php
                 
               }

            ?>
         <div class="col-md-6 mb-3">
            <img src="images/admin2.jpg" class="img-fluid"alt="image"style="height:110%;">
         </div>
         <div class="col-md-6">
            <h3 class="signin-text mb-3">Edition du profil</h3>

            <form action="#" method="POST">
               <div class="form-group">
                  <label for="email">Pseudo</label>
                  <input type="text" name="newpseudo" id="mailconnect"class="form-control"value="<?php echo $user['pseudo']; ?>">
               </div>
               <div class="form-group">
                  <label for="password">Email</label>
                  <input type="email" name="newmail" id="mdpconnect"class="form-control"value="<?php echo $user['email']; ?>">
               </div>
               <div class="form-group">
                  <label for="password">Mot de passe </label>
                  <input type="password" name="newmdp1" id="mdpconnect"class="form-control"value="<?php ?>">
               </div>
               <div class="form-group">
                  <label for="password">Confirmation mot de passe</label>
                  <input type="password" name="newmdp2" id="mdpconnect"class="form-control"value="<?php ?>">
               </div>
               <button class="btn btn-class"name="formupdate"type="submit">Mettre a jour mon profil</button> <buttton class="btn btn-success"> <a href="connexion.php" class="text-decoration-none text-white">Retour </a></buttton><br>
             
            </form>
         </div>
      </div>
  </div>    
    
    </div>    
   <script src="dash.js"></script>
</body>
</html>
<?php
   }else{
    header('Location: connexion.php');
   }
?>