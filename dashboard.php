<?php
session_start();
require 'database.php';


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
    <title>Dashboard</title>
</head>
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

   
   <!-- page content -->
   <div class="page-content p-4 me-2 mb-5"id="content">
        
        <button id="sidebarCollapse"type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4">
            <i class="fa fa-bars mr-2"></i><small class="text-uppercase fw-bold mx-2">Menu</small>
        </button>
        <?php
           if(isset($_GET['id']) && $_GET['id'] > 0){
 
            $getid = intval($_GET['id']);
            $requser = $dbd->prepare("SELECT *FROM administrateur WHERE id= ?");
            $requser->execute(array($getid));
            $userinfo = $requser->fetch();
           ?>
          
          <?php
                  ?>
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                     <strong>BIENVENU  <?= $userinfo['pseudo']; ?></strong>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <?php


        ?>
       
          <section class="container py-5 me-3">
            <div class="row">
                <div class="col-lg-8 col-sm mb-5 mx-auto">
                    <h1 class="fs-4 text-center lead text-info fw-bold"> GESTION PAIE DE LA SCOLARITE(GPSC)</h1>
                </div>
            </div>
            <div class="dropdown-divider border-danger"></div>
            <div class="row">
                <div class="col-md-6">
                    <h5 class="fw-bold mb-0">liste des etudiants</h5>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end">
                    <a class="btn btn-primary btn-sm me-3" href="ajouter-etudiant.php"> <i class="fas fa-folder-plus"></i>
                            Ajouter un etudiant
                    </a>
                    </div>
                </div>
            </div>
            <div class="dropdown-divider border-danger"></div>
            <div class="row">
                <div class="table-responsive" id="orderTable">
                <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Matricule</th>
                            <th scope="col">Nom</th>
                            <th scope="col">NumeroTel</th>
                            <th scope="col">Email</th>
                            <th scope="col">Filiere</th>
                            <th scope="col">Sexe</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Date.V</th>
                            <th scope="col">R.a payer</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($i = 1; $i < 80; $i++):  ?>
                            <tr>
                            <th scope="row"><?= $i ?></th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>
                                <a href="#" class="text-info me-2 infoBtn"title="Voir details"><i class="fas fa-info-circle"></i></a>
                                <a href="#" class="text-primary me-2 editBtn"title="Modifier"><i class="fas fa-edit"></i></a>
                                <a href="#" class="text-danger me-2 deleteBtn"title="Supprimer"><i class="fas fa-trash-alt"></i></a>
                            </td>
                            </tr>
                            <?php endfor; ?>
                        </tbody>
                        </table>
                </div>
            </div>
          </section>
   </div>
                 <script src="dash.js"></script>
                <script src="scriptDataTable/jquery-3.5.1.js"></script>
                <script src="scriptDataTable/jquery.dataTables.min.js"></script>
                <script src="scriptDataTable/rosto.infinity.js"></script>
</body>
</html>
<?php
}
?>
