<?php
require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");



if(isset($_GET["id"])){
    $userId = $_SESSION["userId"];
  $queryParameter = $_GET["id"];
  global $connectingDB;
  $sql = "DELETE FROM stories WHERE id='$queryParameter' AND user_id = '$userId' ";
  $execute = $connectingDB->query($sql);
  if ($execute) {
    $_SESSION["successMessage"]="Story Deleted Successfully ! ";
    redirectTo("my-stories.php");
    // code...
  }else {
    $_SESSION["errorMessage"]="Something Went Wrong. Try Again !";
    redirectTo("my-stories.php");
  }
}
