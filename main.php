<?php
echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITI-PHP</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
';

@require_once('loginHeader.php');

@require_once('handleError.php');

if(!isset($_SESSION['userName'])){
    header('Location: register.html');
    exit;
}

echo '
<main id="mainTable">
<table class="table">
        <thead>
            <tr>
                <td>name</td>
                <td>address</td>
                <td>email</td>
                <td>phone</td>
                <td>country</td>
                <td>image profile</td>
                <td>department</td>
                <td colspan="2">Action</td>
            </tr>
        </thead>
';
$data = file("customer.txt");
foreach ($data as $key => $value) {
    $user = explode("|", $value);
    echo "<td> $user[0] </td> ";
    echo "<td> $user[2] </td> ";
    echo "<td> $user[3] </td> ";
    echo "<td> $user[4] </td> ";
    echo "<td> $user[5] </td> ";
    foreach($user as $key => $value){
        if(substr($value, 0, 6) == "images"){
            echo "<td> <img src='$value' alt='image profile' width='50px' height='50px'> </td> ";
            break;
        }
    }
    echo "<td> $user[7] </td> ";
    echo "<td> <a href='edit.php?userName=$user[0]'> Edit </a> </td> ";
    echo "<td> <a href='delete.php?userName=$user[0]'> Delete </a> </td> ";
    echo "</tr> ";
}
echo '
    </table>  
    </main>  
</body>
</html>
';


