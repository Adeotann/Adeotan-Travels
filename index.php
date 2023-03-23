<?php

require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");

?>

<!-- Header Section -->
<?php require_once("inc/layout/header.php");?>
<!-- Header Section -->

    <!-- Main content -->
    <div class="container">
        <!-- H1 Text -->
        <div class="mt-5 text-center">
            <h1>Welcome To Adeotan Travels!</h1>
            <h5>Your number one travel story website.</h5>
        </div>
        <div class="mt-5 mb-5 text-center">
            <h3>Stories</h3>
        </div>
        <!-- Users Stories -->
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
                    <a href="story-details.php?id=<?php echo $storyId ;?>" class="stretched-link"></a>                    
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

