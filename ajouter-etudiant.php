<?php
require 'database.php';

if(isset($_POST['insert'])){
    $etudiant = htmlspecialchars($_POST['nom']);
    $tel = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $sex = htmlspecialchars($_POST['sexe']);
    $fil = htmlspecialchars($_POST['filiere']);
    $montant = htmlspecialchars($_POST['montant']);
    $date = htmlspecialchars($_POST['date']);
    $state = htmlspecialchars($_POST['statut']);
      if(!empty($_POST['nom']) && !empty($_POST['phone']) && !empty($_POST['sexe']) && !empty($_POST['filiere']) && !empty($_POST['montant']) &&
      !empty($_POST['date']) && !empty($_POST['statut'])){
          $namelength = strlen($etudiant);
          if($namelength <= 100){
                 if(preg_match("#^6[0-9]{8}$#", $_POST['phone'])){
                    if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])){
                            
                    }else{
                        $error = "l'email n'est pas valide";
                    }
                 }else{
                    $error = "numero de telephone invalide";
                 }
          }else{
            $error ="le nom ne doit pas depasser 100 caracteres";
          }
      }else{
        $error = "Tous les champs doivent etre remplis";
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
    <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
    <script src="vendor/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="styleDataTable/jquery.dataTables.min.css">
    <link rel="stylesheet" href="styleDataTable/dataTables.bootstrap.min.css">
    <script src="jquery.js"></script>
    <title>Ajouter-etudiant</title>
<body>
    

<div class="vertical-nav bg-white" id="sidebar">
       <div class="py-4 px-3 mb-4 bg-light">
           <div class="media d-flex align-items-center">
              <img src="images/CFPCanadienne.png" alt=""style="width: 120px;">
              <div class="media-body">
                  <h4 class="mx-3">APP</h4>
                  <P class="font-weight-normal text-muted mb-0 mx-3">Gestion Paie Scolarite(GPSC)</P>
              </div>
           </div>
       </div>

       <P class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0 fw-bold">Etudiants</P>

       <ul class="nav flex-column bg-white mb-0">
        <li class="nav-item">
            <a href="#" class="nav-link text-dark bg-light">
                <i class="fa fa-tachometer mr-3 text-primary fa-fw"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link text-dark">
                <i class="fas fa-file mr-3 text-primary fa-fw"></i>
                Montant par filiere
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
                <a href="editer-profile.php" class="nav-link text-dark">
                    <i class="fa-solid fa-user-pen mr-3 text-primary fa-fw"></i>
                    Editer profile
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark">
                    <i class="fa-sharp fa-solid fa-address-card mr-3 text-primary fa-fw"></i>
                    Profil admin
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

   <div class="page-content p-4 me-2 mb-5"id="content">
        <button id="sidebarCollapse"type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4">
            <i class="fa fa-bars mr-2"></i><small class="text-uppercase fw-bold mx-2">Menu</small>
        </button>

        <div class="row"style="margin-left: 200px; margin-top: -70px;">
                <div class="col-md-10">
               
                    <div class="card">
                        <div class="card-header">
                            <h4>Nouvel etudiant</h4>
                            <a href="#"class="btn btn-danger float-end">Annuler</a>
                        </div>
                        <?php
               if(isset($error)){
                  ?>
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                     <strong><?= $error;  ?></strong>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <?php
                 
               }

            ?>
                        <div class="card-body">
                                 <form action="" method="post">
                                       <div class="mb-2">
                                        <label>Nom</label>
                                        <input type="text" name="nom"id="nom" class="form-control"value="<?php if(isset($etudiant)){ echo $etudiant;} ?>">
                                       </div>

                                       <div class="mb-2">
                                        <label>Email</label>
                                        <input type="text" name="email"id="email" class="form-control"value="<?php if(isset($email)){ echo $email;} ?>">
                                       </div>

                                       <div class="mb-2">
                                        <label>Numero tel</label>
                                        <input type="text" name="phone"id="tel" class="form-control"value="<?php if(isset($tel)){ echo $tel;} ?>">
                                       </div>

                                     <div class="mb-2">
                                        <label>filiere</label>
                                        <select name="filiere" id="filiere"class="form-control"value="<?php if(isset($fil)){ echo $fil;} ?>">
                                            <?php
                                            $sql = "SELECT * FROM filliere ORDER BY id";
                                            $requete = $dbd->query($sql);
                                            $filieres = $requete->fetchAll();

                                            foreach($filieres as $filiere){
                                                echo '<option value="' . $filiere['id'] . '">' . $filiere['nom'] . '</option>';
                                            }
                                            
                                            ?>
                                     </select>   
                                       </div>
                                       <div class="mb-2">
                                        <label>Sexe</label>
                                        <select name="sexe" id="sexe"class="form-control"value="<?php if(isset($sex)){ echo $sex;} ?>">
                                            <option value="1">M</option>
                                            <option value="2">F</option>
                                        </select>
                                       </div>
                                       <div class="mb-2">
                                        <label>Montant</label>
                                        <input type="text" name="montant" class="form-control"value="<?php if(isset($montant)){ echo $montant;} ?>">
                                       </div>
                                       <div class="mb-2">
                                        <label>Date du versement</label>
                                        <input type="date" name="date" class="form-control"value="<?php if(isset($date)){ echo $date;} ?>">
                                       </div>
                                       <div class="mb-2">
                                        <label>Statut</label>
                                         <select name="statut" id="statut"class="form-control"value="<?php if(isset($state)){ echo $state;} ?>">
                                                <?php
                                                $stat = "SELECT * FROM statut ORDER BY id";
                                                $state = $dbd->query($stat);
                                                $statut= $state->fetchAll();

                                                foreach($statut as $state){
                                                    echo '<option value="' . $state['id'] . '">' . $state['nom'] . '</option>';
                                                }
                                                
                                                ?>
                                         </select>
                                       </div>
                                       <div class="mb-2">
                                           <button type="submit"name="insert"class="btn btn-primary"><i class="fas fa-plus"></i>Ajouter</button>
                                       </div>
                                 </form>
                         </div>
                     </div>
                 </div>
              </div>

<script src="dash.js"></script>
</body>
</html>