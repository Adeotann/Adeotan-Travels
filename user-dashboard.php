<?php

require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");

$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
confirmLogin(); 

$userId = $_SESSION["userId"];

?>

<!-- Header Section -->
<?php require_once("inc/layout/header.php");?>
<!-- Header Section -->

    <!-- Main content -->
    <div class="container">
        <div class="mt-5 mb-5">
            <h3>Welcome, <?php echo $_SESSION["fullName"]?></h3>
        </div>
        <div class="mt-5 mb-5 text-center">
            <a href="add-story.php" class="btn btn-primary" role="button">Add Story</a>
            <a href="my-stories.php" class="btn btn-warning" role="button">My Stories</a>
            <a href="#" class="btn btn-success" role="button">Edit Profile</a>            
        </div>
        <div class="mt-5 mb-5 text-center">
            <h3>You have 3 Stories</h3>
        </div>
         <!-- User Stories -->        
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
                global $connectingDB;
                $sql  = "SELECT * FROM stories WHERE user_id = '$userId' ORDER BY id desc";
                $stmt = $connectingDB->query($sql);           
                while ($DataRows = $stmt->fetch()) {
                    $storyId        = $DataRows["id"];
                    $storyTitle  = $DataRows["title"];
                    $storyLocation = $DataRows["location"];
                    $storyImage  = $DataRows["image"];
                    $storyDesc     = $DataRows["description"];
                    $storyAuthor     = $DataRows["author"];                
                    
            ?>
            <div class="col">
                <div class="card h-100">
                <img height="300" src="<?php echo htmlentities($storyImage)?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlentities($storyTitle)?></h5>
                    <p><b>Location:</b> <?php echo htmlentities($storyLocation)?></p>
                    <p class="card-text"><?php echo htmlentities($storyDesc)?></p>
                    <a href="my-story-details.php?id=<?php echo $storyId ;?>" class="stretched-link"></a>                    
                </div>
                </div>
            </div>
            <?php }?>    
        </div> 
           
    </div>
    <!-- Main content -->

<!-- Footer Section -->
<?php require_once("inc/layout/footer.php");?>   
<!-- Footer Section -->

   