<?php
session_start();
$userName = @$_SESSION['userName'];
$image;

if(!$userName){
    header('Location: login.html');
    exit;
}

require_once 'database.php';
$db = new dataBase();

$db->connect($dbConnect,$dbUserName, $dbPassword);
$user = $db->getInfo($userName, 'users');

$user = $user[0];
$image = $user['image'];

echo "
<link rel='stylesheet' href='style.css'>
    <header>
        <div>
            <a href='index.html'>
                ITI PHP
            </a>
        </div>
        <nav>
            <ul>
            <li><a href='index.html'>home</a></li>
            <li><a href='main.php'>users</a></li>
            <li><a href='edit.php?userName=$userName'>$userName</a></li>
            <li><img src='$image' width='50px' height='50px'></li>

            </ul>
        </nav>
    </header>

";