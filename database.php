<?php

declare(strict_types=1);
$dbUserName = 'ITI_PHP';
$dbPassword = 'ITI_PHP';

$dbConnect = 'mysql:host=localhost;dbname=iti;port=3306;';
class dataBase{
    public $username;
    public $password;
    public $connect;

    function __construct(){
    }
    public function connect($connect,$username, $password){
        $this->username = $username;
        $this->password = $password;
        $this->connect = $connect;
    }

    public function fetchData($tableName){
        try{
            $dp = new PDO($this->connect, $this->username, $this->password);
            $query = "select * from $tableName";
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

    public function getInfo($id, $tableName, $idName = 'name'){
        try{
            $dp = new PDO($this->connect, $this->username, $this->password);
            $query = "select * from $tableName where $idName = '$id'";
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

    function deleteUser(string $id, $tableName, $idName = 'name'){
        try{
            if(!$id){
                return false;
            }
            $dp = new PDO($this->connect, $this->username, $this->password);
    
            $user = $this->getInfo($id, $tableName);
            $user = $user[0];
    
            $query = "delete from $tableName where $idName = '$id'";
            $stmt = $dp->prepare($query);
            $stmt ->execute();
            unlink($user['image']);
            $dp = null;
            return true;
        }catch(Exception $e){
            echo $e->getMessage();
            return false;
        }
    }

    function updateUser(array $data, $tableName, $id, $idName = 'name'){
        try{
        $dp = connect();
        $query = "
        update $tableName
        set email = '$data[email]', password = '$data[password]', phone = '$data[phone]', address = '$data[Address]',
            department = '$data[department]', skilllang = '$data[skillLang]', skilldatabase = '$data[skillDatabase]',
            skillfreamwork = '$data[skillFramework]', image = '$data[image]'
        where $idName = '$id'
        ";
        $stmt = $dp->prepare($query);
        $stmt ->execute();
        $result = $stmt->fetchall();
        $dp = null;
        return true;
        }catch(Exception $e){
            echo $e->getMessage();
            return false;
        }
    }

    function setData(array $data, $tableName, $id){
        try{
            $dp = connect();
            $query = "
            insert into $tableName ( name, email, password, phone, address, department, country, skilllang, skilldatabase,
                            skillfreamwork, image)
                            values('$data[name]', '$data[email]', '$data[password]', '$data[phone]', '$data[Address]',
                                    '$data[department]', '$data[country]', '$data[skillLang]', '$data[skillDatabase]',
                                    '$data[skillFramework]', '$data[image]') 
                            ";
            $stmt = $dp->prepare($query);
            $stmt ->execute();
            $result = $stmt->fetchall();
            $dp = null;
            return true;
        }catch(Exception $e){
            echo $e->getMessage();
            return false;
        }
    } 
}

function connect(){
    try{
        $username = 'ITI_PHP';
        $password = 'ITI_PHP';
        
        $connect = 'mysql:host=localhost;dbname=iti;port=3306;';
        return new PDO($connect, $username, $password);
    }catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
}

function fetchData($tableName){
    try{
        $dp = connect();
        $query = "select * from '$tableName'";
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
    $query = "select * from users where name = '$name'";
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

