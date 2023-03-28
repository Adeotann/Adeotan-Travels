<?php

require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");

$pageTitle = 'Edit Story';

$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
confirmLogin(); 


    $userId = $_SESSION["userId"];

    $queryParameter = $_GET["id"];
    global $connectingDB;
    $sql ="SELECT * FROM stories WHERE id = '$queryParameter' AND user_id = '$userId' ";
    $stmt = $connectingDB->query($sql);
    
    while ($DataRows = $stmt->fetch()){

        $getStoryId        = $DataRows["id"];
        $getStoryUserId   = $DataRows['user_id'];
        $getStoryTitle  = $DataRows["title"];
        $getStoryLocation = $DataRows["location"];
        $getStoryCategory = $DataRows["category"];
        $getStoryImage  = $DataRows["image"];
        $getStoryDesc     = $DataRows["description"];
        $getStoryAuthor     = $DataRows["author"]; 
        $created_at     = $DataRows["created_at"];    

    }

    
    if ($userId !== $getStoryUserId){
        logUserOut();
    }

if(isset($_POST["edit"])){
    $storyTitle              = $_POST["storyTitle"];
    $location                = $_POST["location"];
    $category                = $_POST["category"];
    $image                = $_POST["image"];
    $randImgNameGen          = imageNameChange(20);
    $image                   = "uploads/story-images/".$randImgNameGen .'.jpg';
    $description             = $_POST["description"];
    $Temp_Image              = $_FILES["image"]["tmp_name"];
    $Target_Image            = "uploads/story-images/".basename($image);

    $description             = $_POST["description"];
            
      
    if(empty($storyTitle) || empty($location) || empty($description)){
      $_SESSION["errorMessage"]= "All fields must be filled out";
          
    }else{
      // Query to UPDATE User story if validation passes
      global $connectingDB;
      //if the image iput is empty, update the row with the existing image, 
      //else, UPDATE the row with the new image
        if(empty($Temp_Image)){
            $sql = "UPDATE stories SET title = '$storyTitle', location = '$location', category = '$category', description = '$description' WHERE id = '$queryParameter' AND user_id ='$userId' ";
        }else{
            $sql = "UPDATE stories SET title = '$storyTitle', location = '$location', category = '$category', image = '$image', description = '$description' WHERE id = '$queryParameter' AND user_id ='$userId'  ";
            move_uploaded_file($Temp_Image, $Target_Image);
        }
      $execute=$connectingDB->query($sql);     
      if($execute){
        $_SESSION["successMessage"]="Your Story was Edited successfully";  
        redirectTo("my-stories.php");
      }else {
        $_SESSION["errorMessage"]= "Something went wrong. Try Again !";
        //redirectTo("my-stories.php");
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
            <a href="add-story.php" class="btn btn-primary" role="button">Add Story</a>
            <a href="user-dashboard.php" class="btn btn-warning" role="button">Dashboard</a>
            <a href="#" class="btn btn-success" role="button">Edit Profile</a>            
        </div>     
        <div class="mt-5 mb-5 text-center">
            <h3>Edit Story</h3>
        </div>
        <div class="col-lg-6 offset-md-3">
                <?php
                    echo errorMessage();
                    echo successMessage();                   
                ?>
            <form action="edit-story.php?id=<?php echo $queryParameter; ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Story Title</label>
                    <input name="storyTitle" type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo htmlentities($getStoryTitle); ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Story Location</label>
                    <select name="location" class="form-select" aria-label="Default select example">
                        <option value="<?php echo htmlentities($getStoryLocation)?>"><?php echo htmlentities($getStoryLocation)?></option>
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
                    <label for="exampleFormControlInput1" class="form-label">Story Category</label>
                    <select name="category" class="form-select" aria-label="Default select example">
                        <option value="<?php echo htmlentities($getStoryCategory)?>"><?php echo htmlentities($getStoryCategory)?></option>
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
                    <img height="100" width="100" src="<?php echo htmlentities($getStoryImage)?>" alt="Story Image">
                    <input name="image" class="form-control" type="file" id="formFile">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo htmlentities($getStoryDesc); ?></textarea>
                  </div>                          
                <div class="d-grid">
                    <button name="edit" type="submit" class="btn btn-primary">Edit Story</button>
                </div>
            </form>
        </div>
              
    </div>
    <!-- Main content -->
    
<!-- Footer Section -->
<?php require_once("inc/layout/footer.php");?>   
<!-- Footer Section -->
    
 