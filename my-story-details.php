<?php

require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");

$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
confirmLogin(); 

        $userId = $_SESSION["userId"];

        $queryParameter = $_GET["id"];
        global $connectingDB;
        $sql ="SELECT * FROM stories WHERE id = '$queryParameter' AND user_id = '$userId' ";
        $stmt = $connectingDB->query($sql);
        $DataRows = $stmt->fetch();
        
        $storyId        = $DataRows["id"];
        $storyUserId   = $DataRows['user_id'];
        $storyTitle  = $DataRows["title"];
        $storyLocation = $DataRows["location"];
        $storyImage  = $DataRows["image"];
        $storyDesc     = $DataRows["description"];
        $storyAuthor     = $DataRows["author"]; 
        $created_at     = $DataRows["created_at"];     
        
        
    if ($userId !== $storyUserId){
        $_SESSION["userId"]=null;
        $_SESSION["userName"]=null;
        $_SESSION["fullName"]=null;
        session_destroy();
        redirectTo("login.php");
    }
  

?>

<!-- Header Section -->
<?php require_once("inc/layout/header.php");?>
<!-- Header Section -->

    <!-- Main content -->
    <div class="container">
        <div class="mt-5 mb-5 text-center">
            <a href="add-story.php" class="btn btn-primary" role="button">Add Story</a>
            <a href="my-stories.php" class="btn btn-warning" role="button">My Stories</a>
            <a href="#" class="btn btn-success" role="button">Edit Profile</a>            
        </div>
        <div class="mt-5 mb-5 text-center">
            <h3>Story Details</h3>
        </div>
        <!-- Story Details -->
        <div class="card mb-3">
            <img height="400" src="<?php echo htmlentities($storyImage)?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlentities($storyTitle)?></h5>
              <p class="card-text"><?php echo htmlentities($storyDesc)?></p>

              <a href="edit-story.php?id=<?php echo $storyId;?>" class="btn btn-primary" role="button">Edit</a>
              <a href="delete-my-story.php?id=<?php echo $storyId;?>" class="btn btn-danger" role="button">Delete</a>
              <p class="card-text"><small class="text-muted">Posted by: <?php echo htmlentities($storyAuthor)?>, on <?php echo htmlentities($created_at)?></small></p>              
            </div>            
        </div>       
           
    </div>
    <!-- Main content -->

<!-- Footer Section -->
<?php require_once("inc/layout/footer.php");?>   
<!-- Footer Section -->
  