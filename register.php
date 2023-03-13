<?php 
require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");

if(isset($_POST["submit"])){
    $fullname                 = $_POST["fullname"];
    $username                = $_POST["username"];
    $email                = $_POST["email"];
    $password              = $_POST["password"];
    $confirmPassword               = $_POST["confirmPassword"];
    $hash                     = password_hash($password, PASSWORD_BCRYPT);
    $isAdmin                    = 0;
    date_default_timezone_set("Africa/Lagos");
    $currentTime=time();
    $created_at = strftime("%B-%d-%Y at %I:%M:%p",$currentTime);
  
    if(empty($username)||empty($password)||empty($confirmPassword)){
      $_SESSION["errorMessage"]= "All fields must be filled out";
      redirectTo("register.php");
    }elseif (strlen($password)<4) {
      $_SESSION["errorMessage"]= "Password should be greater than 3 characters";
      redirectTo("register.php");
    }elseif ($password !== $confirmPassword) {
      $_SESSION["errorMessage"]= "Password and Confirm Password should match";
      redirectTo("register.php");
    }elseif (checkUserNameExistsOrNot($username)) {
      $_SESSION["errorMessage"]= "Username Exists. Try Another One! ";
      redirectTo("register.php");
    }elseif(checkEmailExistsOrNot($email)){
      $_SESSION["errorMessage"]= "Email Exists. Try Another One! ";
      redirectTo("register.php");      
    }else{
      // Query to insert new admin in DB When everything is fine
      global $connectingDB;
      $sql = "INSERT INTO users(full_name, username, email, password, is_admin, created_at)";
      $sql .= "VALUES(:full_name, :username, :email, :password, :is_admin, :created_at)";
      $stmt = $connectingDB->prepare($sql);
      $stmt->bindValue(':full_name', $fullname);      
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':password', $hash);
      $stmt->bindValue(':is_admin', $isAdmin);
      $stmt->bindValue(':created_at', $created_at);
      $execute = $stmt->execute();      
      if($execute){
        $_SESSION["successMessage"]="Your Sign Up was successful";
        redirectTo("register.php");
      }else {
        $_SESSION["errorMessage"]= "Something went wrong. Try Again !";
        redirectTo("register.php");
      }
    }
  } //Ending of Submit Button If-Condition
  


?>


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
            <a class="navbar-brand" href="#">Adeotan Travels</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="text-light navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>                               
            </ul>
            
            <div class="d-flex" role="search">
                <ul class="navbar-nav me-auto d-flex mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Login</a>
                    </li>
                                               
                </ul>
            </div>
            </div>
        </div>
    </nav>
    <div class="container">       
        <div class="mt-5 mb-5 text-center">
            <h3>Register</h3>
        </div>
        <div class="col-lg-6 offset-md-3">
                <?php
                    echo errorMessage();
                    echo successMessage();
                    echo errorMessageForRg();
                ?>
            <form action="register.php" method="POST">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Full Name</label>
                    <input name="fullname" type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                    <input name="username" type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                    <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="inputPassword" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Confirm Password</label>
                    <input name="confirmPassword" type="password" class="form-control" id="inputPassword" placeholder="name@example.com">
                </div>
                <div class="d-grid">
                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>              
    </div>

     <!-- footer -->
     <footer class="mt-5 navbar bg-dark navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">        
        <div class="container-fluid">
            <li class="text-center">
                <a class="navbar-brand" href="#"><span>&copy</span> 2023 Adeotan Travels</a>                      
            </li>
            
        </div>
    </footer>
    <!-- footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>