<?php

require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");

$pageTitle = 'Stories';

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
        </div>     
        <div class="mt-5 mb-5 text-center">
            <h3>Approved Stories</h3>
        </div>
        <div class="col-md-6 offset-md-3">
            <?php
                echo errorMessage();
                echo successMessage();                    
            ?>
        </div>
         <!-- Stories -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
            global $connectingDB;
            $sql  = "SELECT * FROM stories WHERE is_approved = 1 ORDER BY id desc";
            $stmt = $connectingDB->query($sql);
            $Sr = 0;
            while ($DataRows = $stmt->fetch()) {
                $storyId        = $DataRows["id"];
                $storyTitle  = $DataRows["title"];
                $storyLocation = $DataRows["location"];
                $storyCategory = $DataRows["category"];
                $storyImage  = $DataRows["image"];
                $storyDesc     = $DataRows["description"];
                $storyAuthor     = $DataRows["author"]; 
                $isApproved     = $DataRows["is_approved"];
                $created_at     = $DataRows["created_at"];                
                
        ?>  
        <div class="col">
              <div class="card h-100">
              <img height="300" src="<?php echo htmlentities($storyImage)?>" class="card-img-top" alt="...">
              <div class="card-body">
                    <h5 class="card-title"><?php echo htmlentities($storyTitle)?></h5>
                    <p><b>Location:</b> <?php echo htmlentities($storyLocation)?></p>
                    <p><b>Category:</b> <?php echo htmlentities($storyCategory)?></p>
                    <p class="card-text"><?php if(strlen($storyDesc)>35){$storyDesc = substr($storyDesc,0,35).'...';}
                        echo htmlentities($storyDesc) ;?>
                    </p>
                  <a href="approve-story-details.php?id=<?php echo $storyId ;?>" class="stretched-link"></a>
                    <!-- Approved Notification -->
                    <?php if($isApproved ==1){?>
                            <button type="button" class="btn btn-sm btn-success" disabled>Approved</button>
                    <?php }elseif($isApproved == 0){?>
                            <button type="button" class="btn btn-sm btn-secondary" disabled>Unapproved</button>
                    <?php }?>
                    <!-- Approved Notification -->  
                    <p><b>Posted By:</b> <?php echo htmlentities($storyAuthor)?>, on <?php echo htmlentities($created_at)?></p>                                       
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
