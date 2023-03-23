<?php

require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");

$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
confirmLogin(); 

if($_SESSION["isAdmin"] == 0){ 
    logUserOut();
}

if(isset($_POST["submit"])){
    $location                    = $_POST["location"];
    $addedBy                  = $_SESSION["username"];

    // Put current date and time into the created_at Column
    date_default_timezone_set("Africa/Lagos");
    $currentTime=time();
    $created_at = strftime("%B-%d-%Y at %I:%M:%p",$currentTime);
  
    if(empty($location)){
      $_SESSION["errorMessage"]= "All fields must be filled out";
      redirectTo("add-location.php"); 
    }elseif (checkLocationExistsOrNot($location)) {
        $_SESSION["errorMessage"]= "Location Exists.!!! ";
        redirectTo("add-location.php");
    }else{
      // Query to insert new category in DB When validation passes
      global $connectingDB;
      $sql = "INSERT INTO locations(location, added_by, created_at)";
      $sql .= "VALUES(:location, :added_by, :created_at)";
      $stmt = $connectingDB->prepare($sql);
      $stmt->bindValue(':location', $location);      
      $stmt->bindValue(':added_by', $addedBy);      
      $stmt->bindValue(':created_at', $created_at);
      
      $execute = $stmt->execute();      
      if($execute){
        $_SESSION["successMessage"]="Your Location was added successfully";
        redirectTo("add-location.php");
      }else {
        $_SESSION["errorMessage"]= "Something went wrong. Try Again !";
        redirectTo("add-location.php");
      }
    }
} //End of Submit Button If-Condition
  

?>

<!-- Header Section -->
<?php require_once("inc/layout/header.php");?>
<!-- Header Section -->

    <!-- Main content -->
    <div class="container">
        <div class="mt-5 mb-5 text-center">
            <a href="user-dashboard.php" class="btn btn-warning" role="button">Dashboard</a>                        
        </div>     
        <div class="mt-5 mb-5 text-center">
            <h3>Add Category</h3>
        </div>
        <div class="col-lg-6 offset-md-3">
                <?php
                    echo errorMessage();
                    echo successMessage();
                    echo errorMessageForRg();
                ?>
            <form action="add-location.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Category Title</label>
                    <input name="location" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Category Title">
                </div>                       
                <div class="d-grid">
                    <button name="submit" type="submit" class="btn btn-primary">Add Location</button>
                </div>
            </form>
        </div>
              
    </div>
    <!-- Main content -->
    
<!-- Footer Section -->
<?php require_once("inc/layout/footer.php");?>   
<!-- Footer Section -->
    
 