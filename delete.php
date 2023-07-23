<?php

$userName = @$_GET['userName'];

session_start();
$data = file("customer.txt");
foreach ($data as $key => $value) {
    $user = explode("|", $value);
    if ($user[0] == $userName) {
        unset($data[$key]);
        if($user[0] === $_SESSION['userName']){
            unset($_SESSION['userName']);
            unset($_SESSION['password']);
        }
    }
}

$file = fopen("customer.txt", "w");
foreach ($data as $key => $value) {
    fwrite($file, $value);
}
fclose($file);

header("location:main.php");
?>
