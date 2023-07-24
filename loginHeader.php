<?php
session_start();
$userName = @$_SESSION['userName'];
$image;

require_once 'database.php';
$user = getInfo($userName);
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