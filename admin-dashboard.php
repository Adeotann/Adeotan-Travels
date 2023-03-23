<?php

require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");

$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
confirmLogin();

if($_SESSION["isAdmin"] == 0){ 
  logUserOut();
}

$adminUserId = $_SESSION["userId"];

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
            <a href="approve-stories.php" class="btn btn-primary" role="button">Approve Stories</a>
            <a href="add-category.php" class="btn btn-success" role="button">Add Category</a>
            <a href="add-location.php" class="btn btn-dark" role="button">Add Location</a>
        </div>
        <div class="mt-5 mb-5 text-center">
            <h3>Users</h3>
        </div>
         <!-- Users -->
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">Admin</th>
              </tr>
            </thead>
            
            <tbody>            
              <?php
                global $connectingDB;
                $sql = "SELECT * FROM users ORDER BY id asc";
                $execute =$connectingDB->query($sql);
                $SrNo = 0;
                while ($DataRows=$execute->fetch()) {
                $userId        = $DataRows["id"];              
                $username     = $DataRows["username"];
                $fullName      = $DataRows["full_name"];
                $email        = $DataRows["email"];
                $isAdmin        = $DataRows["is_admin"];
                $SrNo++;
              ?>
                <?php if($userId !== $adminUserId){ ?>
                  <tr>
                    <th scope="row"></th>
                    <td><?php echo htmlentities($username)?></td>
                    <td><?php echo htmlentities($fullName)?></td>
                    <td><?php echo htmlentities($email)?></td>
                    <?php if($isAdmin){?>
                      <td><button href="#" class="btn btn-sm btn-danger" role="button">Yes</button></td>
                    <?php }else{?>
                      <td><button href="#" class="btn btn-sm btn-dark" role="button">No</button></td>
                    <?php }?>
                  </tr>
                <?php }?>
             <?php }?>
            </tbody>
        </table>
           
    </div>
    <!-- Main content -->

<!-- Footer Section -->
<?php require_once("inc/layout/footer.php");?>   
<!-- Footer Section -->
    