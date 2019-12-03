<?php

require_once("../includes/connection.php");

class Comment
{
    public function create($user_id, $song_id, $commentBody)
    {
        $db = new DB();
        $con = $db->connect();

        if ($con) {
            try {
                $stmt = $con->prepare("INSERT INTO `comments` (`song_id`, `user_id`, `comment_body`) VALUES (:song_id, :user_id, :comment_body);");

                $stmt->bindParam(':user_id', $user_id);
                $stmt->bindParam(':song_id', $song_id);
                $stmt->bindParam(':comment_body', $commentBody);
                $stmt->execute();

                $db->disconnect($con);
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        } else {
            $stmt = null;
            $db->disconnect($con);
            return false;
        }
    }

    public function read()
    {
        $db = new DB();
        $con = $db->connect();

        if ($con) {
            try {
                $stmt = $con->prepare('SELECT * FROM comments ORDER BY updated_at');
                $stmt->execute();
                $result = $stmt->fetchAll();

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

    public function update()
    {
        //
    }

    public function delete()
    {
        //
    }
}
