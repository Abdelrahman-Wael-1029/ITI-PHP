<?php
echo "<pre>";;

if (
    !isset($_POST['password']) || !isset($_POST['Address'])
    || !isset($_POST['email']) || !isset($_POST['phone']) 
    || !isset($_POST['department']) || !isset($_FILES['image'])
) {
    header('Location: edit.php?error=missing data');
    exit;
}

$userName = $_POST['userName'];
require_once 'database.php';

$data = getInfo($userName);

$user = $data[0];

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

if(!validImage($_FILES['image'])){
    header('Location: edit.php?error=invalid image');
    exit;
}

$currentPath = $_FILES['image']['tmp_name'];
$extension = pathinfo($_FILES['image']['name'])['extension'];
$newName = "images/" . time() . ".$extension";
move_uploaded_file($currentPath, $newName);

$user['image'] = $newName;
$user['email'] = $_POST['email'];
$user['password'] = $_POST['password'];
$user['phone'] = $_POST['phone'];
$user['Address'] = $_POST['Address'];
$user['department'] = $_POST['department'];

if(isset($_POST['skillLang']))
    $user['skillLang'] = implode(",", $_POST['skillLang']);
else $user['skillLang'] = null;
if(isset($_POST['skillDatabase']))
    $user['skillDatabase'] = implode(",", $_POST['skillDatabase']);
else $user['skillDatabase'] = null;
if(isset($_POST['skillFramework']))
    $user['skillFramework'] = implode(",", $_POST['skillFramework']);
else $user['skillFramework'] = null;

session_start();
$_SESSION['password'] = $user['password'];


updateUser($user);

header('Location: main.php');
