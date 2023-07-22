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
$skills = [];
foreach ($_POST as $key => $value) {
    if (gettype($value) == 'array') {
        $skills[$key] = $value;
    }
}

$address = $_POST['Address'];
$country = $_POST['country'];
$gender = $_POST['gender'];
$password = $_POST['password'];

$username = $_POST['userName'];
$code = $_POST['code'];

if ($code != '123456') {
    echo "please enter the correct code";
    exit();
}

echo "<b>thanks</b>  ";
if ($gender === 'male')
    echo '<b style="color:blue;">Mr. </b>';
else
    echo '<b style="color:blue;">Mrs. </b>';
echo $username . "<br>";

echo 'please review your information: <br>';
echo "<ul>";

echo "<li>Name : $username </li>" . "<br>";

echo "<li>Address : $address </li>" . "<br>";
if (count($skills)  > 0)
    echo "<li><span>Your Skills :</span></li>";
foreach ($skills as $key => $value) {
    echo "<ul> <li><span>$key<span></li>";
    foreach ($value as $skill) {
        echo "<ul> <li>$skill</li> </ul>";
    }
    echo "</ul>";
}

echo "<li>Department : $code</li>" . "<br>";

echo "</ul>";
