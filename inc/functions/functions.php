<?php

function imageNameChange($length){
  $token = "StoryImage";
  $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

  $max = strlen($codeAlphabet);

    for ($i=0; $i < $length; $i++)
    {
      $token .= $codeAlphabet [random_int(0, $max-1)];
    }

    return $token;

}

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

function checkCategoryExistsOrNot($title){
  global $connectingDB;
  $sql    = "SELECT title FROM categories WHERE title=:title";
  $stmt   = $connectingDB->prepare($sql);
  $stmt->bindValue(':title',$title);
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
  $sql = "SELECT * FROM users WHERE email=:userName OR username =:userName LIMIT 1";
  $stmt = $connectingDB->prepare($sql);
  $stmt->bindValue(':userName',$username);
  // $stmt->bindValue(':PassworD',$hash);
  $stmt->execute();
  $result = $stmt->rowcount();
  if ($result == 1) {
    return $foundAccount = $stmt->fetch();
  }else {
    return null;
  }
}

function confirmLogin(){
    if (isset($_SESSION["userId"])) {
    return true;
    }  else {
    $_SESSION["ErrorMessage"]="Login Required !";
    redirectTo("login.php");
    }
}

function redirectTo($New_Location){
  header("Location:".$New_Location);
  exit;
}

function logUserOut(){
  $_SESSION["userId"]=null;
  $_SESSION["userName"]=null;
  $_SESSION["fullName"]=null;
  session_destroy();
  redirectTo("login.php");
}