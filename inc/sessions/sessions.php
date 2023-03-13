<?php
session_start();

function errorMessage(){
  if(isset($_SESSION["errorMessage"])){
    $output = "<div class=\"alert alert-danger text-center\">" ;
    $output .= htmlentities($_SESSION["errorMessage"]);
    $output .= "</div>";
    $_SESSION["errorMessage"] = null;
    return $output;
  }
}

function errorMessageForRg(){
  if(isset($_SESSION["errorMessageForRg"])){
    $output = "<div class=\"alert alert-danger text-center\">" ;
    $output .= htmlentities($_SESSION["errorMessageForRg"]);
    $output .= "</div>";
    $_SESSION["errorMessageForRg"] = null;
    return $output;
  }
}

function successMessage(){
  if(isset($_SESSION["successMessage"])){
    $output = "<div class=\"alert alert-success text-center\">" ;
    $output .= htmlentities($_SESSION["successMessage"]);
    $output .= "</div>";
    $_SESSION["successMessage"] = null;
    return $output;
  }
}

 ?>
