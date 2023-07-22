<?php

$userName = $_GET['userName'];


$data = file("customer.txt");
foreach ($data as $key => $value) {
    $user = explode("|", $value);
    if ($user[0] == $userName) {
        unset($data[$key]);
    }
}

$file = fopen("customer.txt", "w");
foreach ($data as $key => $value) {
    fwrite($file, $value);
}
fclose($file);

header("location:main.php");
