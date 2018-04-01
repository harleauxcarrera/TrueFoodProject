<?php

class DB_Manager
{
    private $conn;
 
    //Constructor
    function __construct()
    {
        require_once dirname(__FILE__) . '/DB_Credentials.php';
        require_once dirname(__FILE__) . '/DB_Connect.php';
        // opening db connection
        $db = new DB_Connect();
        $this->conn = $db->connect();
    }
 
    //Function to create a new user
    public function createUser($pass, $email )
    {
        if (!$this->doesUserExist($email)) {
            $password = md5($pass);
            $stmt = $this->conn->prepare("INSERT INTO Users ( password, email ) VALUES (?, ?)");
            $stmt->bind_param("ss", $password, $email );
            if ($stmt->execute()) {
                return USER_CREATED;
            } else {
                return USER_NOT_CREATED;
            }
        } else {
            return USER_ALREADY_EXIST;
        }
    }
 
    public function userPresent($email, $psswrd){
        $user_exists = false;
        if($this->doesUserExist($email)){
            $stmt = $this->conn->prepare("SELECT password FROM Users WHERE email = ? ");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($hashed_pwd);
            $stmt->fetch();
            $given_pwrd = md5($psswrd);//hash to see if hashes match

            if(strcmp($given_pwrd,$hashed_pwd) == 0){
                $user_exists = true;
            }else{
                $user_exists = false;
            }
        }else{
           $user_exists = false;
        }
        return $user_exists;
    }
    
    private function doesUserExist( $email)
    {
        $stmt = $this->conn->prepare("SELECT id FROM Users WHERE email = ? ");
        $stmt->bind_param("s", $email );
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
}