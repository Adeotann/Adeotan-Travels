<?php

require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");

$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
confirmLogin();

if($_SESSION["isAdmin"] == 0){ 
  logUserOut();
}  


if(isset($_GET["id"])){

  $queryParameter = $_GET["id"];
  global $connectingDB;
  $sql = "UPDATE stories SET is_approved = 0 WHERE id = '$queryParameter' ";
  $execute = $connectingDB->query($sql);
  if ($execute) {
    $_SESSION["successMessage"]="Story Disapproved !! ";
    redirectTo("approve-stories.php");
    // code...
  }else {
    $_SESSION["errorMessage"]="Something Went Wrong. Try Again !";
    redirectTo("approve-stories.php");
  }
}