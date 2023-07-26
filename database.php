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
            return false;
        }
    }

    public function getInfo($id, $tableName, $idName = 'username'){
        try{
            $dp = new PDO($this->connect, $this->username, $this->password);
            $query = "select * from $tableName where $idName = '$id'";
            $stmt = $dp->prepare($query);
            $stmt ->execute();
            $result = $stmt->fetchall();
            $dp = null;
            return $result;
        }catch(Exception $e){
            return false;
        }
    }

    function deleteUser(string $id, $tableName, $idName = 'username'){
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
            return false;
        }
    }

    function updateUser(array $data, $tableName, $id, $idName = 'username'){
        try{
        $dp = new PDO($this->connect, $this->username, $this->password);
        $query = "
        update $tableName
        set email = '$data[email]', password = '$data[password]', phone = '$data[phone]', address = '$data[Address]',
            department = '$data[department]', skills = '$data[skills]', image = '$data[image]'
        where $idName = '$id'
        ";
        $stmt = $dp->prepare($query);
        $stmt ->execute();
        $result = $stmt->fetchall();
        $dp = null;
        return true;
        }catch(Exception $e){
            return false;
        }
    }

    function setData(array $data, $tableName, $id){
        try{
            $dp = new PDO($this->connect, $this->username, $this->password);
            $query = "
            insert into $tableName ( username, email, password, phone, address, department, gender, country, skills, image)
                            values('$data[userName]', '$data[email]', '$data[password]', '$data[phone]', '$data[Address]',
                                    '$data[department]', '$data[gender]', '$data[country]', '$data[skills]', '$data[image]') 
                            ";
            $stmt = $dp->prepare($query);
            $stmt ->execute();
            $result = $stmt->fetchall();
            $dp = null;
            return true;
        }catch(Exception $e){
            return false;
        }
    } 
}