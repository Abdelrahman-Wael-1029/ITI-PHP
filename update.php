<?php
if (
     !isset($_POST['password']) || !isset($_POST['Address'])
    || !isset($_POST['email']) || !isset($_POST['phone'])
) {
    echo "Please fill all the fields";
    exit();
}


$userName = $_POST['userName'];

$data = file("customer.txt");

$user;
$index;
foreach($data as $key => $value){
    $temp = explode("|", $value);
    if($temp[0] == $userName){
        $user = $value;
        $index = $key;
    }
}

$user = explode("|", $user);

$user[1] = $_POST['password'];
$user[2] = $_POST['Address'];
$user[3] = $_POST['email'];
$user[4] = $_POST['phone'];


$data[$index] = implode("|", $user);
$file = fopen("customer.txt", "w");

foreach($data as $value){
    fwrite($file, $value);
}

fclose($file);

header('Location: main.php');
