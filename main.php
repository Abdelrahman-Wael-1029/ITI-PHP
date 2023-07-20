<?php
if (
    !isset($_POST['firstName']) || !isset($_POST['lastName']) || !isset($_POST['Address'])
    || !isset($_POST['country']) || !isset($_POST['gender']) || !isset($_POST['password'])
    || !isset($_POST['lang']) || !isset($_POST['database']) || !isset($_POST['userName'])
    || !isset($_POST['code']) || !isset($_POST['department'])
) {
    echo "Please fill all the fields";
    exit();
}



$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$address = $_POST['Address'];
$country = $_POST['country'];
$gender = $_POST['gender'];
$password = $_POST['password'];
$lang = $_POST['lang'];
$database = $_POST['database'];
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
echo $firstName . " " . $lastName . "<br>";

echo 'please review your information: <br>';
echo "<ul>";

echo "<li>Name : $username </li>" . "<br>";

echo "<li>Address : $address </li>" . "<br>";

echo "<li><p>Your Skills :</p></li>";
echo "<ul>";
echo "<li>Programming Languages :</p>";
echo "<ul>";
foreach ($lang as $value) {
    echo "<li> $value </li>" . "<br>";
}
echo "</ul>";

echo "<li>Database :</li>";
echo "<ul>";

foreach ($database as  $value) {
    echo "<li> $value </li>" . "<br>";
}
echo "</ul>";
echo "</ul>";

echo "<li>Department : $code</li>" . "<br>";
