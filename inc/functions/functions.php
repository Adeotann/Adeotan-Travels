<?php

function checkUserNameExistsOrNot($username){
  global $connectingDB;
  $sql    = "SELECT username FROM users WHERE username=:userName";
  $stmt   = $connectingDB->prepare($sql);
  $stmt->bindValue(':userName',$username);
  $stmt->execute();
  $Result = $stmt->rowcount();
  if ($Result==1) {
    return true;
  }else {
    return false;
  }
}

function checkEmailExistsOrNot($email){
  global $connectingDB;
  $sql    = "SELECT email FROM users WHERE email=:email";
  $stmt   = $connectingDB->prepare($sql);
  $stmt->bindValue(':email',$email);
  $stmt->execute();
  $Result = $stmt->rowcount();
  if ($Result==1) {
    return true;
  }else {
    return false;
  }
}



function loginAttempt($username){
  global $connectingDB;
  $sql = "SELECT * FROM users WHERE username=:userName LIMIT 1";
  $stmt = $connectingDB->prepare($sql);
  $stmt->bindValue(':userName',$username);
  // $stmt->bindValue(':PassworD',$hash);
  $stmt->execute();
  $Result = $stmt->rowcount();
  if ($Result == 1) {
    return $Found_Account=$stmt->fetch();
  }else {
    return null;
  }
}

function confirmLogin(){
    if (isset($_SESSION["userId"])) {
    return true;
    }  else {
    $_SESSION["ErrorMessage"]="Login Required !";
    Redirect_to("login.php");
    }
}

function redirectTo($New_Location){
  header("Location:".$New_Location);
  exit;
}