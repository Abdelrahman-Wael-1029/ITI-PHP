<?php

$userName = $_GET['userName'];

$data = file("customer.txt");

$user;
foreach($data as $key => $value){
    $temp = explode("|", $value);
    if($temp[0] == $userName){
        $user = $value;
    }
}
$user = explode("|", $user);

@require_once('loginHeader.php');

echo "
<link rel='stylesheet' href='style.css'>
<main id='registrationForm'>
<div>
    <p>Edit form</p>
</div>

<div>
    <form action='update.php' method='post'>
    ";
        @require_once('handleError.php');
echo "
        <div >
            <div>
                <label for='email'>email</label>
                <input required type='email' name='email' id='email' value=$user[3]>
            </div> 
        </div>
        <div class='more'>
            <div>
            <label for='password'>password:</label>
            <input required type='password' name='password' id='password' value=$user[1]>
        </div>
            <div>
                <label for='phone'>phone</label>
                <input required type='text' name='phone' id='phone' value=$user[4]>
            </div>
        </div>
        <div class='more'>
            <div>
                <label for='Adress'>Address:</label>
                <textarea name='Address' id='Address' rows='2' >$user[2]</textarea>
            </div>
            <div>
                <label for='department'>department:</label>
                <select name='department' id='department'>
                    <option value='IT'>IT</option>
                    <option value='HR'>HR</option>
                    <option value='Sales'>Sales</option>
                    <option value='Marketing'>Marketing</option>
                    <option value='Finance'>Finance</option>
                </select>
            </div>
        </div>
        <div class='more skills'>
                    <div>
                        <span>language skils:</span>
                        <div class='allSkills'>
                            <div>
                                <input type='checkbox' name='skillLang[]' value='php' id='php'>
                                <label for='php'>php</label>
                            </div>
                            <div>
                                <input type='checkbox' name='skillLang[]' value='java' id='java'>
                                <label for='java'>java</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <span> database:</span>
                        <div class='allSkills'>
                            <div>
                                <input type='checkbox' name='skillDatabase[]' value='mysql' id='mysql'>
                                <label for='mysql'>mysql</label>
                            </div>
                            <div>
                                <input type='checkbox' name='skillDatabase[]' value='oracle' id='oracle'>
                                <label for='oracle'>oracle</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <span> framework:</span>
                        <div class='allSkills'>
                            <div>
                                <input type='checkbox' name='skillFramework[]' value='laravel' id='laravel'>
                                <label for='laravel'>laravel</label>
                            </div>
                            <div>
                                <input type='checkbox' name='skillFramework[]' value='spring' id='spring'>
                                <label for='spring'>spring</label>
                            </div>
                        </div>
                    </div>
                </div>
        <input required type='text' name='userName' id='user Name' value='$user[0]'hidden>

        <div>
            <input type='reset'>
            <input type='submit' value='update'>
        </div>

    </form>
</div>

</main>
";




echo '<script src="main.js"></script>';


?>