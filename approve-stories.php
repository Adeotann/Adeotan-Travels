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
            <a href="#" class="btn btn-primary" role="button">Admin Dashboard</a>            
        </div>     
        <div class="mt-5 mb-5 text-center">
            <h3>Unapproved Stories</h3>
        </div>
         <!-- Stories -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <div class="col">
              <div class="card h-100">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
              </div>
          </div>
          <div class="col">
              <div class="card h-100">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">This is a short card.</p>
              </div>
              </div>
          </div>
          <div class="col">
              <div class="card h-100">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
              </div>
              </div>
          </div>
          <div class="col">
              <div class="card h-100">
              <img src="..." class="card-img-top" alt="...">
              <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
              </div>
          </div>
        </div>  
        
           
    </div>
    <!-- Main content -->

<!-- Footer Section -->
<?php require_once("inc/layout/footer.php");?>   
<!-- Footer Section -->
