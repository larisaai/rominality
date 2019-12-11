<?php

require_once("../includes/connection.php");
require_once("Attribute_class.php");

class Song
{
    public function create($user_id, $song_title, $artist_name, $price, $currency, $path, $tagsId)
    {
        $db = new DB();
        $con = $db->connect();

        if ($con) {
            try {
                $stmt = $con->prepare("INSERT INTO `songs` (`user_id`, `song_title`, `price`, `currency`, `path_id`, `artist_name`) VALUES ( :user_id, :song_title, :price, :currency, :rel_path, :artist_name);");

                $stmt->bindParam(':user_id', $user_id);
                $stmt->bindParam(':song_title', $song_title);
                $stmt->bindParam(':artist_name', $artist_name);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':currency', $currency);
                $stmt->bindParam(':rel_path', $path);
                $stmt->execute();


                $db->disconnect($con);

                $attributeRelationship = new Attribute();

                foreach ($tagsId as $tagId) {
                    $attributeRelationship->addAttributeRel($con->lastInsertId(), $tagId);
                };

                return $this;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        } else {
            $stmt = null;
            $db->disconnect($con);
            return false;
        }
    }

    public function getSong($song_id)
    {
        $db = new DB();
        $con = $db->connect();

        $result = [];

        if ($con) {
            try {
                $stmt = $con->prepare("SELECT * FROM `songs` WHERE id = :id;");
                $stmt->bindParam(":id", $song_id);
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

    public function all()
    {
        $db = new DB();
        $con = $db->connect();
        if ($con) {
            try {
                $stmt = $con->prepare('SELECT * FROM songs ORDER BY song_title DESC');
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

    public function getSongsBasedOnUserId($user_id)
    {
        $db = new DB();
        $con = $db->connect();
        if ($con) {
            try {
                $stmt = $con->prepare('SELECT * FROM songs WHERE user_id = :user_id');
                $stmt->bindParam(':user_id', $user_id);
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

    public function getRandomSongs()
    {
        $db = new DB();
        $con = $db->connect();
        if ($con) {
            try {
                $stmt = $con->prepare('SELECT * FROM songs ORDER BY RAND() LIMIT 5');
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

    public function searchSong($value)
    {
        $db = new DB();
        $con = $db->connect();

        if ($con) {
            try {
                $stmt = $con->prepare("SELECT song_title FROM songs WHERE song_title LIKE CONCAT('%', :search_term, '%') ORDER BY song_title DESC");
                $stmt->bindParam(':search_term', $value);
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
}
