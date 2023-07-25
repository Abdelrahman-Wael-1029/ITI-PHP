<?php

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

$db = new dataBase();
$db->connect($dbConnect, $dbUserName, $dbPassword);
$data = $db->fetchDAta('users');

foreach ($data as $key => $value) {
    $user = $value;
    echo "<td> $user[name] </td> ";
    echo "<td> $user[address] </td> ";
    echo "<td> $user[email] </td> ";
    echo "<td> $user[phone] </td> ";
    echo "<td> $user[country] </td> ";
    echo "<td> <img src='$user[image]' alt='image profile' width='50px' height='50px'> </td> ";
    echo "<td> $user[department] </td> ";
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


