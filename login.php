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

$data = file("customer.txt");

foreach($data as $key => $value){
    $user = explode("|", $value);
    if($user[0] === $userName && $user[1] === $password){
        session_start();
        $_SESSION['userName'] = $userName;
        $_SESSION['password'] = $password;
        header('Location: main.php');
        exit;
    }
    if($user[0] === $userName && $user[1] !== $password){
        header('Location: login.html?error=wrong password');
        exit;
    }
}
header('Location: login.html?error=not found please register');