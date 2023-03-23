<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register/Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Adeotan Travels</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="text-light navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <?php if(isset($_SESSION["userId"])){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="user-dashboard.php">User Dashboard</a>
                    </li>  
                <?php }?>
                <?php if($_SESSION["isAdmin"]){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin-dashboard.php">Admin Dashboard</a>
                    </li>  
                <?php }?>                           
            </ul>
            
            <div class="d-flex" role="search">
                <ul class="navbar-nav me-auto d-flex mb-2 mb-lg-0">
                    <?php if(!isset($_SESSION["userId"])){ ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="login.php">Login</a>
                        </li> 
                    <?php } ?>
                    <?php if(isset($_SESSION["userId"])){ ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="logout.php">Logout</a>
                        </li>
                    <?php }?>                                           
                </ul>
            </div>
            </div>
        </div>
    </nav>