<?php
function validUserName(string $userName){
    $regex = "/[a-zA-Z ]+/";
    return preg_match($regex, $userName);
}

function validEmail(string $email){
    $regex = "/[\w]+@[\w]+\\.[\w]+/";
    return preg_match($regex, $email);
    // --second way
    
    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     return false;
    // }
    // return true;
}

function validPass($password){
    $regex = "/(?!\.*[A-Z])[a-z\d\\-]{8}/";
    return preg_match($regex, $password);
}

function validImage($image){
    $curPath = $_FILES['image']['tmp_name'];
    $extension = pathinfo($image['name'])['extension'];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    if(!in_array($extension, $allowedExtensions)){
        return false;
    }
    return true;
}