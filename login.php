<?php

if (
    !isset($_POST['userName']) || !isset($_POST['password'])
) {
    header('Location: login.html?error=missing data');
    exit;
}
$userName = $_POST['userName'];
$password = $_POST['password'];

$userName = trim(strtolower($userName));
$password = trim(strtolower($password));

require_once 'database.php';
$db = new dataBase();
$db->connect($dbConnect, $dbUserName, $dbPassword);
$find =$db->getInfo($userName, 'users');
if(count($find)){
    if($find[0]['password'] == $password){
        session_start();
        $_SESSION['userName'] = $userName;
        $_SESSION['password'] = $password;
        header('Location: main.php');
        exit;
    }
}

header('Location: login.html?error=not found please register');