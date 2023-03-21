<?php

require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");

$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
confirmLogin(); 


if(isset($_POST["submit"])){
    $title                    = $_POST["title"];
    $addedBy                  = $_SESSION["username"];
    $adminId                  = $_SESSION["userId"];

    // Put current date and time into the created_at Column
    date_default_timezone_set("Africa/Lagos");
    $currentTime=time();
    $created_at = strftime("%B-%d-%Y at %I:%M:%p",$currentTime);
  
    if(empty($title)){
      $_SESSION["errorMessage"]= "All fields must be filled out";
      redirectTo("add-category.php"); 
    }elseif (checkCategoryExistsOrNot($title)) {
        $_SESSION["errorMessage"]= "Category Exists.!!! ";
        redirectTo("add-category.php");
    }else{
      // Query to insert new category in DB When validation passes
      global $connectingDB;
      $sql = "INSERT INTO categories(title, added_by, admin_id, created_at)";
      $sql .= "VALUES(:title, :added_by, :admin_id, :created_at)";
      $stmt = $connectingDB->prepare($sql);
      $stmt->bindValue(':title', $title);      
      $stmt->bindValue(':added_by', $addedBy);
      $stmt->bindValue(':admin_id', $adminId);
      $stmt->bindValue(':created_at', $created_at);
      
      $execute = $stmt->execute();      
      if($execute){
        $_SESSION["successMessage"]="Your Category was added successfully";       
      }else {
        $_SESSION["errorMessage"]= "Something went wrong. Try Again !";
        redirectTo("add-category.php");
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
            <a href="#" class="btn btn-success" role="button">Edit Profile</a>            
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
            <form action="add-category.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Category Title</label>
                    <input name="title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Category Title">
                </div>                       
                <div class="d-grid">
                    <button name="submit" type="submit" class="btn btn-primary">Add Category</button>
                </div>
            </form>
        </div>
              
    </div>
    <!-- Main content -->
    
<!-- Footer Section -->
<?php require_once("inc/layout/footer.php");?>   
<!-- Footer Section -->
    
 