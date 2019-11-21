<?php


require_once("connection.php");

class Users
{
    function add($first_name, $last_name, $email, $password, $confirm_password)
    {
        $db = new DB();
        $con = $db->connect();
      
        if ($con) {
            try {
                $stmt = $con->prepare(" INSERT INTO users ( name, last_name, email, password, confim_password, active )
                        VALUES (:firstname, :lastname, :email, :password, :confirm_password, 1)");
                $stmt->bindParam(':firstname', $first_name);
                $stmt->bindParam(':lastname', $last_name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':confirm_password', $confirm_password);
                $ok = $stmt->execute();

                $stmt = null;
                $db->disconnect($con);

                return ($ok);
            } catch (PDOException $e) {
                echo $e;
            }
        } else {
            $stmt = null;
            $db->disconnect($con);
            return false;
        }
    }


    

}