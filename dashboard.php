
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vendor/css/bootstrap.min.css">
    <script src="vendor/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-te-1.4.0.min.js"></script>
    <link rel="stylesheet" href="dash.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
    <script src="vendor/fontawesome/js/all.min.js"></script>
    <script src="jquery.js"></script>
    <title>Dashboard</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
  <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
              <span class="navbar-toggler-icon"data-bs-target="#offcanvasExample"><i class="fa fa-bars"></i></span>
    </button>

    <a class="navbar-brand fw-bold me-auto" href="#"><img src="images/CFPCanadienne.png" class="img-fluid"style="width: 150px;">
  </a>
  <h3 class="mx-5 fw-2 text-dark">Dashboard</h1>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <form class="d-flex ms-auto" role="search">
      <div class="input-group mb-3 my-1">
        <input type="text" class="form-control" placeholder="Search....." aria-label="Recipient's username" aria-describedby="button-addon2">
        <button class="btn btn-danger" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
        </div>
      </form>
        <ul class="navbar-nav mb-2 mb-lg-3">        
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-danger" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user text-danger"></i>
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Ajouter un admin</a></li>
                        <hr class="dropdown-divider">
                        <li><a href="#" class="dropdown-item">Logout</a></li>
                    </ul>
            </li>
    </div>
  </div>
</nav>

<!-- ofcanvas starts -->
    <div class="offcanvas bg-light offcanvas-start sidebar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    
    <div class="offcanvas-body p-0">
         <nav class="navbar-light">
            <ul class="navbar-nav my-5 mx-4">
                <li>
                    <div class="text-muted small fw-bold text-uppercase">administrateur</div>
                </li>
                <li>
                    <a href="#" class="nav-link px-3 active">
                            <span class ="me-2">
                                <i class="fa fa-users fs-4"></i>
                                <span>Etudiants</span>
                            </span>
                    </a>

                    <li>
                    <a href="#" class="nav-link px-3">
                            <span class ="me-2">
                                <i class="fa fa-file fs-4"></i>
                                <span>Filieres</span>
                            </span>
                    </a>
                </li>                    <li class="my-4">
                  <hr class="dropdown-divider">
                </li>
            </ul>
         </nav>
    </div>
    </div>

<!-- offcanvas ends -->
    
</body>
</html>