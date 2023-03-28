<?php 
require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");

$pageTitle = 'Register/Signup';

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
  
    //Check if inputs are empty
    if(empty($fullname) || empty($username) || empty($email) || empty($password) || empty($confirmPassword)){
      $_SESSION["errorMessage"]= "All fields must be filled out";
      redirectTo("register.php");
    }elseif (strlen($password)<5) {
      $_SESSION["errorMessage"]= "Password should be greater than 5 characters";
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
      // Query to insert new user into the DB if validation passes
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

        }     
      }else {
        $_SESSION["errorMessage"]= "Something went wrong. Try Again !";
        redirectTo("register.php");
      }
    }
} //Ending of Submit Button If-Condition
  


?>

<!-- Header Section -->
<?php require_once("inc/layout/header.php");?>
<!-- Header Section -->

    <!-- Main content -->
    <div class="container give-min-height">       
        <div class="mt-5 mb-5 text-center">
            <h3>Register</h3>
        </div>
        <div class="col-lg-6 offset-md-3">
                <?php
                    echo errorMessage();
                    echo successMessage();                    
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
    <!-- Main content -->

<!-- Footer Section -->
<?php require_once("inc/layout/footer.php");?>   
<!-- Footer Section -->

 