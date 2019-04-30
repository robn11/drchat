<?php

class User {
    public $customerid;
    public $username;
    public $isDR;
    public $data;
    public $database;
    
    function __construct($username, $database) {
        $this->username = $username;
        $this->database = $database;

        $sql = get_sql('getCustomerByUsername');
        $params = array("username"=>$username);
        $statement = $database->prepare($sql);
        $statement->execute($params);
        $customer = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->data = $customer[0];
        $this->isDR = $customer[0]['isDR'];
        $this->customerid = $customer[0]['customerid'];
    }

    function authenticate ($username, $password, $database) {
        $sql = get_sql('authenticateUser');
        $params = array('username' => $username );
        $statement = $database->prepare($sql);
        $statement->execute($params);
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if(!empty($users)) {
            $existingHashFromDB = $users[0]['password'];
            $isPasswordCorrect = password_verify($password, $existingHashFromDB);
            
            if($isPasswordCorrect) {
                /*$sql = get_sql('getCustomerByUsername');
                $params = array('username' => $username);
                $statement = $database->prepare($sql);
                $users = $statement->execute($params);
                $_SESSION['user'] = $users[0]['username'];*/
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        else {
            return FALSE;
        }
    }

    function createNewUser($username, $password, $database) {
        //$database = $this->database;
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        
        $sql = get_sql('addNewUser');
        $params = array('username' => $username, 'password' => $passwordHash);
        $statement = $database->prepare($sql);
        $statement->execute($params);

        return $database->lastInsertId();
    }

    function deleteUser($id) {
        $database = $this->$database;
        $sql = get_sql('removeUser');
        $params = array('id' => $id);
        $statement = $database->prepare($sql);
        $statement->execute($params);
    }

    function set($key, $value) {
        $this->$key = $value;
        return $this;
    }

    function save($database) {
        $params = array(
            "username"=>$this->username,
            "name"=>$this->name,
            "email"=>$this->email,
            "phone"=>$this->phone,
            "address"=>$this->address,
            "city"=>$this->city,
            "zip"=>$this->zip,
            "isDR"=>$this->isDR
        );
        $sql = get_sql("updateUser");
        $statement = $database->prepare($sql);
        $statement->execute($params);
    }

    function refreshSession($username, $database) {
        $sql = get_sql('getCustomerByUsername');
        $params = array( "username"=>$username );
        $statement = $database->prepare($sql);
        $statement->execute($params);
        $user = $statement->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['user']['username'] = $user[0]['username'];
    }
}
?>