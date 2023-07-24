<?php

$userName = @$_GET['userName'];
if(!$userName){
    header('Location: login.php');
    exit;
}
require_once 'database.php';
session_start();
if($userName === @$_SESSION['userName']){
    session_destroy();
}

deleteUser($userName);

header("location:main.php");
?>
