<?php
if (
    !isset($_POST['userName']) || !isset($_POST['password']) || !isset($_POST['Address'])
    || !isset($_POST['email']) || !isset($_POST['phone']) || !isset($_FILES['image'])
    || !isset($_POST['country']) || !isset($_POST['gender'])
    || !isset($_POST['code']) || !isset($_POST['department'])
) {
    header('Location: register.html?error=missing data');
}
@require_once('validData.php');

$userName = $_POST['userName'];
$userName = trim(strtolower($userName));
if (!validUserName($userName)) {
    header('Location: register.html?error=invalid username');
    exit;
}

$email = $_POST["email"];


if (!validEmail($email)) {
    header('Location: register.html?error=invalid email');
    exit;
}


$password = $_POST["password"];
if (!validPass($password)) {
    header('Location: register.html?error=invalid password');
    exit;
}

$image = $_FILES["image"];
if (!validImage($image)) {
    header('Location: register.html?error=invalid image');
    exit;
}

$currentPath = $_FILES['image']['tmp_name'];
$extension = pathinfo($image['name'])['extension'];
$newName = "images/" . time() . ".$extension";
move_uploaded_file($currentPath, $newName);
$data = file('customer.txt');
foreach ($data as $user) {
    $arr = explode('|', $user);
    if ($arr[0] === $userName) {
        header('Location: register.html?error=user already exists');
        exit;
    }
}

$file = fopen("customer.txt", "a");

fwrite($file, trim(strtolower($userName . '|')));
fwrite($file, trim(strtolower($password . '|')));
fwrite($file, trim(strtolower($_POST['Address'] . '|')));
fwrite($file, trim(strtolower($email . '|')));
fwrite($file, trim(strtolower($_POST['phone'] . '|')));
fwrite($file, trim(strtolower($_POST['country'] . '|')));
fwrite($file, trim(strtolower($_POST['gender'] . '|')));
fwrite($file, trim(strtolower($_POST['department'] . "|")));
fwrite($file, trim(strtolower($newName . "|")));

foreach($_POST as $key => $value){
    if(substr($key, 0, 5)== "skill"){
        fwrite($file, trim(strtolower($key)) . ":");
        foreach($value as $v){
            fwrite($file,trim(strtolower( $v)) . " ");
        }
        fwrite($file, "|");
    }
}
fwrite($file, "\n");

fclose($file);
session_start();
$_SESSION['userName'] = $userName;
$_SESSION['password'] = $password;
echo 
    "
        <script>
            alert('Welcome' + $userName);
        </script>

    ";

header('Location: main.php');
