<?php
echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="padding:20px;">
    <table class="table">
        <thead>
            <tr>
                <td>name</td>
                <td>address</td>
                <td>email</td>
                <td>phone</td>
                <td>country</td>
                <td>gender</td>
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
    echo "<td> $user[6] </td> ";
    echo "<td> $user[7] </td> ";
    echo "<td> <a href='edit.php?userName=$user[0]'> Edit </a> </td> ";
    echo "<td> <a href='delete.php?userName=$user[0]'> Delete </a> </td> ";
    echo "</tr> ";
}
echo '
    </table>    
</body>
</html>
';
