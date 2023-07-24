<?php

declare(strict_types=1);


function connect(){
    try{
        $username = 'ITI_PHP';
        $password = 'ITI-PHP';
        
        $connect = 'mysql:host=localhost;dbname=iti;port=3306;';
        return new PDO($connect, $username, $password);
    }catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
}

function fetchData(){
    try{
        $dp = connect();
        $query = 'select * from users';
        $stmt = $dp->prepare($query);
        $stmt ->execute();
        $result = $stmt->fetchall();
        $dp = null;
        return $result;
    }catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
}

function getInfo (string $name){
    try{
    $dp = connect();
    $query = "select * from users where name = ?";
    $stmt = $dp->prepare($query);
    $stmt ->execute([$name]);
    $result = $stmt->fetchall();
    $dp = null;
    return $result;
    }catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
}

function deleteUser(string $name){
    try{
        if(!$name){
            return false;
        }
        $dp = connect();

        $user = getInfo($name);
        $user = $user[0];

        $query = "delete from users where name = ?";
        $stmt = $dp->prepare($query);
        $stmt ->execute([$user['name']]);
        unlink($user['image']);
        $dp = null;
        return true;
    }catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
}

function updateUser(array $data){
    try{
    $dp = connect();
    $query = "
    update users set email = ?, password = ?, phone = ?, address = ?, department = ?, skilllang = ?, skilldatabase = ?, skillfreamwork = ?, image = ?
    where name = ?
    ";
    $stmt = $dp->prepare($query);
    var_dump($data['department']);
    $stmt ->execute([
        @$data['email'],
        @$data['password'],
        @$data['phone'],
        @$data['Address'],
        @$data['department'],
        @$data['skillLang'],
        @$data['skillDatabase'],
        @$data['skillFramework'],
        @$data['image'],
        @$data['name']
    ]);
    
    $result = $stmt->fetchall();
    $dp = null;
    return true;
    }catch(Exception $e){
        echo $e->getMessage();
        exit;
        return false;
    }
}


function setData(array $data){
    try{
        $dp = connect();
        $query = "
        insert into users( name, email, password, phone, address, department, country, skilllang, skilldatabase,
                        skillfreamwork, image)
                    values(?,?,?,?,?,?,?,?,?,?,?)
            ";
        $stmt = $dp->prepare($query);
        $stmt ->execute([
            @$data['name'],
            @$data['email'],
            @$data['password'],
            @$data['phone'],
            @$data['Address'],
            @$data['department'],
            @$data['country'],
            @$data['skillLang'],
            @$data['skillDatabase'],
            @$data['skillFramework'],
            @$data['image']
        ]);
        $result = $stmt->fetchall();
        $dp = null;
        return true;
    }catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
}   

// setData([
//     'abdelrahman',
//     'abdo@abdo.abdo',
//     '123456',
//     '123456789',
//     'cairo',
//     'IT',
//     'egypt',
//     'php',
//     'null',
//     'null',
//     'images/abdo.jpg'
// ]);