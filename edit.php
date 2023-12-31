<?php
@require_once('loginHeader.php');
require_once 'database.php';
$db = new dataBase();
$db->connect($dbConnect, $dbUserName, $dbPassword);

$user = $db->getInfo($_GET['userName'], 'users');
$user = $user[0];

echo "
<main id='registrationForm'>
<div class='title'>
    <p>Edit form</p>
</div>

<div>
    <form action='update.php' method='post' enctype='multipart/form-data'>
    ";
        @require_once('handleError.php');
echo "
        <div class='more'>
            <div>
                <label for='email'>email</label>
                <input required type='email' name='email' id='email' value='$user[email]'>
            </div> 
                <div>
                    <label for='password'>password:</label>
                    <input required type='password' name='password' id='password' value='$user[password]'>
                </div>
        </div>
        <div class='more'>
            <div>
                <label for='phone'>phone</label>
                <input required type='text' name='phone' id='phone' value='$user[phone]'>
            </div>
                <div>
                    <label for='image'>profile image</label>
                    <input type='file' name='image' id='image' required>
                </div>
        </div>
        <div class='more'>
            <div>
                <label for='Adress'>Address:</label>
                <textarea name='Address' id='Address' rows='2' >$user[address]</textarea>
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
        <div>
        <div class='multi'>
            <div>
                <span>skills</span>
            </div>
            <div>
                <div>
                    <span>language skils:</span>
                    <div class='allmulti'>
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
                    <span> database</span>
                    <div class='allmulti'>
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
                    <div class='allmulti'>
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
            </fieldset>
        </div>
    </div>

        <input required type='text' name='userName' id='userName' value='$user[username]' hidden>

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