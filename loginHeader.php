<?php
session_start();
$userName = @$_SESSION['userName'];

$data = file("customer.txt");
foreach ($data as $key => $value) {
    $user = explode("|", $value);
    foreach($user as $key =>$value){
        if(substr($value, 0, 6) == "images"){
            $image = $value;
            break;
        }
    }
}

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