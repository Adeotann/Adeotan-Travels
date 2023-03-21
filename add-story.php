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
        <div class="mt-5 mb-5 text-center">
            <h3>Add Story</h3>
        </div>
        <div class="col-lg-6 offset-md-3">
            <form action="">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Story Title</label>
                    <input name="storyTitle" type="text" class="form-control" id="exampleFormControlInput1" placeholder="A Trip To Jamica">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Location</label>
                    <input name="location" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Jamica">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Photo</label>
                    <input name="photo" class="form-control" type="file" id="formFile">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                  </div>                          
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Add Story</button>
                </div>
            </form>
        </div>
              
    </div>
    <!-- Main content -->
    
<!-- Footer Section -->
<?php require_once("inc/layout/footer.php");?>   
<!-- Footer Section -->
    
 