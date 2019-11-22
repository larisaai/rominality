<?php

require_once("../includes/connection.php");

class User
{

    //if you have functions that are being used JUST by this class use
    //protected function blalba(){}

    public function create($first_name, $last_name, $email, $password)
    {
        $db = new DB();
        $con = $db->connect();

        if ($con) {

            try {

                if ($this->checkEmailExists($email)) {
                    return false;
                };
                $stmt = $con->prepare(" INSERT INTO users ( firstname, lastname, email, password, is_active, user_type)
                        VALUES (:firstname, :lastname, :email, :password, 1, 1)");
                $stmt->bindParam(':firstname', $first_name);
                $stmt->bindParam(':lastname', $last_name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);

                $ok = $stmt->execute();

                $db->disconnect($con);

                return $this->login($email, $password);
            } catch (PDOException $e) {

                return $e->getMessage();
            }
        } else {
            $stmt = null;
            $db->disconnect($con);
            return false;
        }
    }

    public function login($email, $password)
    {


        $db = new DB();
        $con = $db->connect();


        if ($con) {

            $results = array();
            $stmt = $con->prepare("SELECT * FROM users WHERE email = :email AND password = :password Limit 1");
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

    protected function storeObjectInSession($value, $name)
    {
        session_start();
        $_SESSION[$name] = $value;
    }

    protected function checkEmailExists($email)
    {

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
