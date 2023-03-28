<?php

require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");

$pageTitle = 'Stories';

?>

<!-- Header Section -->
<?php require_once("inc/layout/header.php");?>
<!-- Header Section -->

    <!-- Main content -->
    <div class="container give-min-height">                
        <div class="mt-5 text-center">
            <h3>Stories</h3>
        </div>
        <div class="mt-2 mb-5 text-center">            
            <form action="filter-results.php" method="GET">
                <div class="row">
                    <div class="col-md-3 mt-1">                        
                        <select name="filter_category" class="form-select" aria-label="Default select example">
                            <option value="0">All Stories</option>
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
                    <div class="col-md-1 mt-1">
                        <button name="filter" type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Users Stories -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
                $getCategory = $_GET['filter_category'];
                global $connectingDB;
                if($getCategory == "0"){
                    $sql  = "SELECT * FROM stories WHERE is_approved = 1 ORDER BY id desc";
                }else{
                    $sql  = "SELECT * FROM stories WHERE  category = '$getCategory' AND is_approved = 1 ORDER BY id desc";
                }                
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
                    <p><b>Posted By:</b> <?php echo htmlentities($storyAuthor)?>, on <?php echo htmlentities($created_at)?></p>               
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

