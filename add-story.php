<?php

require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");

$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
confirmLogin(); 


if(isset($_POST["submit"])){
    $storyTitle              = $_POST["storyTitle"];
    $location                = $_POST["location"];
    // $image                = $_POST["image"];
    $randImgNameGen          = imageNameChange(20);
    $image                   = "uploads/story-images/".$randImgNameGen .'.jpg';
    $description             = $_POST["description"];
    $Temp_Image              = $_FILES["image"]["tmp_name"];
    $Target_Image            = "uploads/story-images/".basename($image);

    $description             = $_POST["description"];
    $category                = $_POST["category"];
    $author                  = $_SESSION["username"];
    $user_id                 = $_SESSION["userId"];
    $is_approved             = 0;

    // Put current date and time into the created_at Column
    date_default_timezone_set("Africa/Lagos");
    $currentTime=time();
    $created_at = strftime("%B-%d-%Y at %I:%M:%p",$currentTime);
  
    if(empty($storyTitle) || empty($location) || empty($Temp_Image) || $category =="0" || $location =="0" || empty($description)){
      $_SESSION["errorMessage"]= "All fields must be filled out";
      redirectTo("add-story.php");    
    }else{
      // Query to insert new story in DB When everything is fine
      global $connectingDB;
      $sql = "INSERT INTO stories(title, location, image, description, author, user_id, category, is_approved, created_at)";
      $sql .= "VALUES(:title, :location, :image, :description, :author, :user_id, :category, :is_approved, :created_at)";
      $stmt = $connectingDB->prepare($sql);
      $stmt->bindValue(':title', $storyTitle);      
      $stmt->bindValue(':location', $location);
      $stmt->bindValue(':image', $image);
      $stmt->bindValue(':description', $description);
      $stmt->bindValue(':author', $author);
      $stmt->bindValue(':user_id', $user_id);      
      $stmt->bindValue(':category', $category);
      $stmt->bindValue(':is_approved', $is_approved);
      $stmt->bindValue(':created_at', $created_at);
      move_uploaded_file($Temp_Image, $Target_Image);
      $execute = $stmt->execute();      
      if($execute){
        $_SESSION["successMessage"]="Your Story was added successfully";       
      }else {
        $_SESSION["errorMessage"]= "Something went wrong. Try Again !";
        redirectTo("add-story.php");
      }
    }
} //Ending of Submit Button If-Condition
  

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
            <h3>Add Story</h3>
        </div>
        <div class="col-lg-6 offset-md-3">
                <?php
                    echo errorMessage();
                    echo successMessage();
                    echo errorMessageForRg();
                ?>
            <form action="add-story.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Story Title</label>
                    <input name="storyTitle" type="text" class="form-control" id="exampleFormControlInput1" placeholder="A Trip To Jamica">
                </div>
                <div class="mb-3">
                    <select name="location" class="form-select" aria-label="Default select example">
                        <option value="0">Location</option>
                        <?php
                        //Fetchinng all the categories from category table
                        global $connectingDB;
                        $sql = "SELECT id,location FROM locations ORDER BY location";
                        $stmt = $connectingDB->query($sql);
                        while ($DataRows = $stmt->fetch()) {
                        $id = $DataRows["id"];
                        $locationTitle = $DataRows["location"];
                        ?>
                        <option value="<?php echo $locationTitle; ?>"> <?php echo $locationTitle; ?></option>
                        <?php }?>                    
                    </select>
                </div>
                <div class="mb-3">
                    <select name="category" class="form-select" aria-label="Default select example">
                        <option value="0">Category</option>
                        <?php
                        //Fetchinng all the categories from category table
                        global $connectingDB;
                        $sql = "SELECT id,title FROM categories ORDER BY title";
                        $stmt = $connectingDB->query($sql);
                        while ($DataRows = $stmt->fetch()) {
                        $id = $DataRows["id"];
                        $categoryTitle = $DataRows["title"];
                        ?>
                        <option value="<?php echo $categoryTitle; ?>"> <?php echo $categoryTitle; ?></option>
                        <?php }?>
                        
                    </select>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Photo</label>
                    <input name="image" class="form-control" type="file" id="formFile">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                  </div>                          
                <div class="d-grid">
                    <button name="submit" type="submit" class="btn btn-primary">Add Story</button>
                </div>
            </form>
        </div>
              
    </div>
    <!-- Main content -->
    
<!-- Footer Section -->
<?php require_once("inc/layout/footer.php");?>   
<!-- Footer Section -->
    
 