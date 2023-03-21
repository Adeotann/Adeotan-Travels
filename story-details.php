<?php

require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");



        $queryParameter = $_GET["id"];
        global $connectingDB;
        $sql ="SELECT * FROM stories WHERE id='$queryParameter'";
        $stmt = $connectingDB->query($sql);
        $DataRows = $stmt->fetch();
        
        $storyId        = $DataRows["id"];
        $storyTitle  = $DataRows["title"];
        $storyLocation = $DataRows["location"];
        $storyImage  = $DataRows["image"];
        $storyDesc     = $DataRows["description"];
        $storyAuthor     = $DataRows["author"]; 
        $created_at     = $DataRows["created_at"];      
  

?>

<!-- Header Section -->
<?php require_once("inc/layout/header.php");?>
<!-- Header Section -->

    <!-- Main content -->
    <div class="container">
        <div class="mt-5 mb-5 text-center">
            <h3>Story Details</h3>
        </div>
        <!-- Story Details -->
        <div class="card mb-3">
            <img height="400" src="<?php echo htmlentities($storyImage)?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlentities($storyTitle)?></h5>
              <p class="card-text"><?php echo htmlentities($storyDesc)?></p>
              <p class="card-text"><small class="text-muted">Posted by: <?php echo htmlentities($storyAuthor)?>, on <?php echo htmlentities($created_at)?></small></p>
            </div>
        </div>       
           
    </div>
    <!-- Main content -->

<!-- Footer Section -->
<?php require_once("inc/layout/footer.php");?>   
<!-- Footer Section -->
  