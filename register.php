<?php

if (
    !isset($_POST['userName']) || !isset($_POST['password']) || !isset($_POST['Address'])
    || !isset($_POST['email']) || !isset($_POST['phone'])
    || !isset($_POST['country']) || !isset($_POST['gender'])
    || !isset($_POST['code']) || !isset($_POST['department'])
) {
    echo "Please fill all the fields";
    exit();
}

$userName = $_POST['userName'];

$data = file('customer.txt');
foreach ($data as $user) {
    $arr = explode('|', $user);
    if ($arr[0] === $userName) {
        echo "User already exists";
        exit();
    }
}

$file = fopen("customer.txt", "a");

fwrite($file, $_POST['userName'] . '|');
fwrite($file, $_POST['password'] . '|');
fwrite($file, $_POST['Address'] . '|');
fwrite($file, $_POST['email'] . '|');
fwrite($file, $_POST['phone'] . '|');
fwrite($file, $_POST['country'] . '|');
fwrite($file, $_POST['gender'] . '|');
fwrite($file, $_POST['department'] . "|");

foreach($_POST as $key => $value){
    if(substr($key, 0, 5)== "skill"){
        fwrite($file, $key . ":");
        foreach($value as $v){
            fwrite($file, $v . " ");
        }
        fwrite($file, "|");
    }
}
fwrite($file, "\n");

fclose($file);

header('Location: main.php');
