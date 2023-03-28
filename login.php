<?php 
require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");

$pageTitle = 'Login';

if(isset($_SESSION["userId"])){
    redirectTo("user-dashboard.php");
}
  
  if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    if (empty($username)||empty($password)) {
      $_SESSION["errorMessage"] = "All fields must be filled out";
      redirectTo("login.php");
    }else {
      // code for checking username and password from Database
    
      $foundAccount=loginAttempt($username);
      if ($foundAccount && password_verify($_POST["password"], $foundAccount["password"])) {
  
        $_SESSION["userId"]=$foundAccount["id"];
        $_SESSION["username"]=$foundAccount["username"];
        $_SESSION["fullName"]=$foundAccount["full_name"];
        $_SESSION["isAdmin"]=$foundAccount["is_admin"];     
        
        if (isset($_SESSION["TrackingURL"])) {
          redirectTo($_SESSION["TrackingURL"]);
        }else{
        redirectTo("user-dashboard.php");
      }
      }else {
        $_SESSION["errorMessage"]="Incorrect Username OR Password";
        redirectTo("login.php");
      }
    }
  }

?>

<!-- Header Section -->
<?php require_once("inc/layout/header.php");?>
<!-- Header Section -->

    <!-- Main content -->
    <div class="container give-min-height">       
        <div class="mt-5 mb-5 text-center">
            <h3>Login</h3>
        </div>
        <div class="col-lg-6 offset-md-3">
                <?php
                    echo errorMessage();
                    echo successMessage();                  
                ?>
            <form action="login.php" method="POST">            
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email Address Or Username</label>
                    <input name="username" type="username" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="inputPassword" placeholder="name@example.com">
                </div>               
                <div class="d-grid">
                    <button name="submit" type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
              
    </div>
    <!-- Main content -->

<!-- Footer Section -->
<?php require_once("inc/layout/footer.php");?>   
<!-- Footer Section -->

