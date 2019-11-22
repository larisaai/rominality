<?php

require_once("connection.php");

class User
{
    function create($first_name, $last_name, $email, $password, $confirm_password)
    {
        $db = new DB();
        $con = $db->connect();
      
        if ($con) {

            try {

                if($this->checkEmailExists($email)){
                    return false;
                };
                $stmt = $con->prepare(" INSERT INTO users ( name, last_name, email, password, confim_password, active )
                        VALUES (:firstname, :lastname, :email, :password, :confirm_password, 1)");
                $stmt->bindParam(':firstname', $first_name);
                $stmt->bindParam(':lastname', $last_name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':confirm_password', $confirm_password);
                $ok = $stmt->execute();
                
                $db->disconnect($con);

                return $this->login($email,$password);

            } catch (PDOException $e) {

                return $e->getMessage();
            }
        } else {
            $stmt = null;
            $db->disconnect($con);
            return false;
        }
    }

    function login( $email, $password)
    {

        $db = new DB();
        $con = $db->connect();

     
        if ($con) {
           
            $results = array();
            $stmt = $con->prepare("SELECT * FROM users WHERE email = :email AND
             password = :password AND
             active = 1 LIMIT 1");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $result = $stmt->execute();
            $user = $stmt->fetch();

            $this->storeObjectInSession($user, "user");
        
            $db->disconnect($con);

            return true;
        } else {
            return false;
         }
    }

    function storeObjectInSession($value, $name){
        session_start();
        $_SESSION[$name] = $value;
    }

    function checkEmailExists($email){
        session_start();
        $db = new DB();
    
        $con = $db->connect();

        if ($con) {
    
            $stmt = $con->prepare("SELECT * FROM users WHERE email = :email ");
            $stmt->bindParam(':email', $email);
            $result = $stmt->execute();
            return $stmt->fetch();

        } else {
            return false;
         }

    }

}