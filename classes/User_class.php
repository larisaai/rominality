<?php

require_once("../includes/connection.php");

class User
{

    //if you have functions that are being used JUST by this class use
    //protected function blalba(){}

    public function create($first_name, $last_name, $email, $password, $confirmPass, $user_type)
    {
        $db = new DB();

        $con = $db->connect();

        if ($con) {

            try {

                $errors = $this->checkDataForErrors($first_name, $last_name, $email, $password, $confirmPass);

                if ($errors) {
                    return $errors;
                };

                $stmt = $con->prepare(" INSERT INTO users ( firstname, lastname, email, password, is_active, user_type, profile_picture)
                        VALUES (:firstname, :lastname, :email, :password, 1, :usertype, 'https://www.pngfind.com/pngs/m/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.png')");
                $stmt->bindParam(':firstname', $first_name);
                $stmt->bindParam(':lastname', $last_name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':usertype', $user_type);


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

    public function checkDataForErrors($first_name, $last_name, $email, $password, $confirmPass)
    {
        if ($confirmPass !== $password) {
            return 'paswords are not matching';
        };

        if ($this->checkEmailExists($email)) {
            return 'email is already taken';
        };
        return false;
    }


    public function login($email, $password)
    {
        $db = new DB();
        $con = $db->connect();

        if ($con) {

            $results = array();
            $stmt = $con->prepare("SELECT * FROM users WHERE email = :email AND password = :password AND is_active = 1 Limit 1");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $result = $stmt->execute();
            $user = $stmt->fetch();

            $db->disconnect($con);

            if ($user) {
                $this->storeObjectInSession($user, "user");
                return true;
            } else {
                return 'invalid-credentials';
            }
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



    public function update($id, $first_name, $last_name, $email, $fileContent, $sExtention)
    {
        $db = new DB();
        $con = $db->connect();

        if ($con) {


            $sUniqueImageName = uniqid() . '.' . $sExtention;

            move_uploaded_file($fileContent, __DIR__ . "/../images/$sUniqueImageName");

            $stmt = $con->prepare('UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, profile_picture = :profilePicture WHERE id = :id');

            $fullPathToProfilePicture = "/images/$sUniqueImageName";

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':firstname', $first_name);
            $stmt->bindParam(':lastname', $last_name);
            $stmt->bindParam(':email', $email);

            $stmt->bindParam(':profilePicture', $fullPathToProfilePicture);
            $ok = $stmt->execute();

            $stmt = null;

            $db->disconnect($con);

            $_SESSION['user']['firstname'] = $first_name;
            $_SESSION['user']['lastname'] = $last_name;
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['profile_picture'] = $fullPathToProfilePicture;


            return ($ok);
        } else
            return false;
    }

    public function update_password($id, $old_password, $new_password)
    {
        $db = new DB();
        $con = $db->connect();

        if ($con) {
            $stmt = $con->prepare('UPDATE users SET password = :password WHERE id = :id');

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':password', $new_password);
            $ok = $stmt->execute();



            $stmt = null;
            $db->disconnect($con);

            $_SESSION['user']['password'] = $new_password;

            return $ok;
        } else
            return false;
    }


    public function delete_account($id)
    {
        $db = new DB();
        $con = $db->connect();

        if ($con) {
            $stmt = $con->prepare('DELETE from users  WHERE id = :id');

            $stmt->bindParam(':id', $id);
            $ok = $stmt->execute();

            $stmt = null;
            $db->disconnect($con);

            return $ok;
        } else
            return false;
    }

    public function getUserFirstnameById($user_id)
    {
        $db = new DB();
        $con = $db->connect();
        if ($con) {
            try {
                $stmt = $con->prepare('SELECT firstname FROM users WHERE id = :user_id');
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();
                $result = $stmt->fetch();

                $db->disconnect($con);
                return $result;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        } else {
            $stmt = null;
            $db->disconnect($con);
            return false;
        }
    }
}
