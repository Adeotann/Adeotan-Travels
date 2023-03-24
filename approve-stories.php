<?php

require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");

$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
confirmLogin();

if($_SESSION["isAdmin"] == 0){ 
  logUserOut();
}  


?>

<!-- Header Section -->
<?php require_once("inc/layout/header.php");?>
<!-- Header Section -->

    <!-- Main content -->
    <div class="container give-min-height">
        <div class="mt-5 mb-5 text-center">
            <a href="admin-dashboard.php" class="btn btn-primary" role="button">Admin Dashboard</a>
            <a href="approved-stories-list.php" class="btn btn-warning" role="button">Approved Stories</a>            
        </div>     
        <div class="mt-5 mb-5 text-center">
            <h3>Unapproved Stories</h3>
        </div>
         <!-- Stories -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
            global $connectingDB;
            $sql  = "SELECT * FROM stories WHERE is_approved = 0 ORDER BY id desc";
            $stmt = $connectingDB->query($sql);
            $Sr = 0;
            while ($DataRows = $stmt->fetch()) {
                $storyId        = $DataRows["id"];
                $storyTitle  = $DataRows["title"];
                $storyLocation = $DataRows["location"];
                $storyImage  = $DataRows["image"];
                $storyDesc     = $DataRows["description"];
                $storyAuthor     = $DataRows["author"]; 
                $isApproved     = $DataRows["is_approved"];                
                
        ?>  
        <div class="col">
              <div class="card h-100">
              <img height="300" src="<?php echo htmlentities($storyImage)?>" class="card-img-top" alt="...">
              <div class="card-body">
                  <h5 class="card-title"><?php echo htmlentities($storyTitle)?></h5>
                  <p class="card-text"><?php echo htmlentities($storyDesc)?></p>
                  <a href="approve-story-details.php?id=<?php echo $storyId ;?>" class="stretched-link"></a>
                    <!-- Approved Notification -->
                    <?php if($isApproved ==1){?>
                        <button type="button" class="btn btn-sm btn-success" disabled>Approved</button>
                    <?php }elseif($isApproved == 0){?>
                        <button type="button" class="btn btn-sm btn-secondary" disabled>Unapproved</button>
                    <?php }?>
                    <!-- Approved Notification -->                   
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
