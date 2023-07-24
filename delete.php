<?php

$userName = @$_GET['userName'];
require_once 'database.php';
session_start();
if($userName === @$_SESSION['userName']){
    session_destroy();
}

$data = fetchData();
$test = deleteUser($userName);

header("location:main.php");
?>
