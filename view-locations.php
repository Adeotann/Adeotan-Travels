<?php

require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");

$pageTitle = 'View Location';

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
            <a href="add-location.php" class="btn btn-warning" role="button">Add Location</a>                        
        </div>     
        <div class="mt-5 mb-5 text-center">
            <h3>All Locations</h3>
        </div>
        <div class="col-md-6 offset-md-3">
            <?php
                echo errorMessage();
                echo successMessage();                    
            ?>
        </div>
        <div class="mb-2">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Location</th>
                    <th scope="col">Added By</th>
                    <th scope="col">Created At</th>                   
                </tr>
                </thead>
                
                <tbody>            
                <?php
                    global $connectingDB;
                    $sql = "SELECT * FROM locations ORDER BY id asc";
                    $execute =$connectingDB->query($sql);
                    $SrNo = 0;
                    while ($DataRows=$execute->fetch()) {
                    $locationId        = $DataRows["id"];   
                    $locationTitle       = $DataRows["location"];              
                    $addedBy     = $DataRows["added_by"];
                    $createdAt      = $DataRows["created_at"];                                       
                    $SrNo++;
                ?>                    
                    <tr>
                        <th scope="row"><?php echo htmlentities($SrNo)?></th>
                        <td><?php echo htmlentities($locationTitle)?></td>
                        <td><?php echo htmlentities($addedBy)?></td>
                        <td><?php echo htmlentities($createdAt)?></td>                       
                    </tr>                
                <?php }?>
                </tbody>
            </table>
        </div>
        
              
    </div>
    <!-- Main content -->
    
<!-- Footer Section -->
<?php require_once("inc/layout/footer.php");?>   
<!-- Footer Section -->
    
 