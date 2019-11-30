<?php

require_once("../includes/connection.php");

class Attribute
{

    public function readAll()
    {
        $db = new DB();
        $con = $db->connect();
        $results = array();
        if ($con) {
            try {
                $stmt = $con->prepare('SELECT * FROM song_attributes ORDER BY attribute_name DESC');
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

    public function getAttributesForId($id)
    {
        $db = new DB();
        $con = $db->connect();
        $results = array();

        if ($con) {
            try {

                $stmt = $con->prepare('SELECT * FROM song_attributes_relationship WHERE song_id = :songId');
                $stmt->bindParam(':songId', $id);
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

    public function getAttributeName($id)
    {
        $db = new DB();
        $con = $db->connect();


        if ($con) {
            try {

                $stmt = $con->prepare('SELECT attribute_name FROM song_attributes WHERE id = :id');
                $stmt->bindParam(':id', $id);
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

    public function update()
    {
        //
    }

    public function delete()
    {
        //
    }

    public function addAttributeRel($song_id, $attribute_id)
    {
        $db = new DB();
        $con = $db->connect();

        if ($con) {
            try {
                $stmt = $con->prepare('INSERT INTO song_attributes_relationship (`song_id`,`attribute_id`) VALUES(:song_id, :attribute_id)');
                $stmt->bindParam(':song_id', $song_id);
                $stmt->bindParam(':attribute_id', $attribute_id);
                $stmt->execute();

                $db->disconnect($con);
                return true;
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
