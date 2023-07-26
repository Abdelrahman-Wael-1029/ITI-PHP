<?php
if (
    !isset($_POST['userName']) || !isset($_POST['password']) || !isset($_POST['Address'])
    || !isset($_POST['email']) || !isset($_POST['phone']) || !isset($_FILES['image'])
    || !isset($_POST['country']) || !isset($_POST['gender'])
    || !isset($_POST['code']) || !isset($_POST['department'])
) {
    echo 'not data';
    exit;
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

require_once 'database.php';
$db = new dataBase();
$db->connect($dbConnect, $dbUserName, $dbPassword);
$find = $db->getInfo($userName, 'users');

if ($find) {
    header('Location: register.html?error=user name already exist');
    exit;
}

$data = [];
$data['skills'] = "";
foreach($_POST as $key=>$value){
    if(substr($key, 0, 5)== "skill"){
        $data['skills'] .= $key. ':' . implode(",", $value).'|';
        continue;
    }
    $data[$key] = $value;
}
$data['image'] = $newName;
$data['name'] = $userName;
$test = $db->setData($data, 'users', $userName);
if(!$test){
    header('Location: register.html?error=error try again');
    exit;
}


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
