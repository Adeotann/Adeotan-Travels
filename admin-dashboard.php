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
        <div class="mt-5 mb-5">
            <h3>Welcome, John Doe</h3>
        </div>
        <div class="mt-5 mb-5 text-center">
            <a href="#" class="btn btn-primary" role="button">Approve Stories</a>
            <a href="#" class="btn btn-success" role="button">View Users</a>
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
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Markavelli</td>
                <td>Mark John</td>
                <td>mark@gmail.com</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacobvella</td>
                <td>Jacob Doe</td>
                <td>jacob@gmail.com</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>Larry Poe</td>
                <td>larry@hotmail.com</td>
              </tr>
            </tbody>
        </table>
           
    </div>
    <!-- Main content -->

<!-- Footer Section -->
<?php require_once("inc/layout/footer.php");?>   
<!-- Footer Section -->
    