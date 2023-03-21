<?php

require_once("inc/db/db_connection.php");
require_once("inc/sessions/sessions.php");
require_once("inc/functions/functions.php");

$_SESSION["userId"]=null;
$_SESSION["userName"]=null;
$_SESSION["fullName"]=null;
session_destroy();
redirectTo("login.php");
?>