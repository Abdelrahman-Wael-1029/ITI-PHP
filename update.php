<?php
echo "<pre>";;

if (
    !isset($_POST['password']) || !isset($_POST['Address'])
    || !isset($_POST['email']) || !isset($_POST['phone'])
) {
    header('Location: edit.php?error=missing data');
    exit;
}


$userName = $_POST['userName'];

$data = file("customer.txt");

$user = 0;

foreach($data as $key => $value){
    $temp = explode("|", $value);
    if($temp[0] == $userName){
        $user = $value;
        unset($data[$key]);
        break;
    }
}

if(!$user){
    header('Location: edit.php?error=try again');
    exit;
}

@require_once('validData.php');

if(!validEmail($_POST['email'])){
    header('Location: edit.php?error=invalid email');
    exit;
}

if(!validPass($_POST['password'])){
    header('Location: edit.php?error=invalid password');
    exit;
}

$user = explode("|", $user);


$user[1] = $_POST['password'];
$user[2] = $_POST['Address'];
$user[3] = $_POST['email'];
$user[4] = $_POST['phone'];
$user[7] = $_POST['department'];


foreach($user as $key =>$value){
    if(substr($value,0, 5) == "skill"){
        unset($user[$key]);
    }
    if($value === "\n " || $value === "" || $value === "\n" || $value === " "){
        unset($user[$key]);
    }
}

foreach($_POST as $key =>$value){
    if(gettype($key) === "string" && substr($key, 0, 5) == "skill"){
        $user[$key] = $value;
    }
}

$file = fopen("customer.txt", "w");

foreach($user as $key=>$value){
    if(gettype($value) !== "string"){continue;}
    if(substr($key, 0, 5) === 'skill'){continue;}
    fwrite($file, $value. '|');
}

foreach($user as $key => $value){
    if(substr($key, 0, 5) === "skill"){
        fwrite($file, $key . ":");
        foreach($value as $v){
            fwrite($file, $v . " ");
        }
        fwrite($file, "|");
    }
}
fwrite($file, "\n");


foreach($data as $value){
    fwrite($file, $value);
}


header('Location: main.php');
