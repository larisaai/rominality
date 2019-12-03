<?php

require_once("../includes/connection.php");
require_once("Song_class.php");

class Invoice
{
    public function create($buyer_id, $items, $cartSongs)
    {
        $db = new DB();
        $con = $db->connect();
        $total = 0;

        if ($con) {
            try {

                $stmt = $con->prepare("INSERT INTO `invoices` (`buyer_id`, `items`) VALUES ( :buyer_id, :items);");
                $stmt->bindParam(':buyer_id', $buyer_id);
                $stmt->bindParam(':items', $items);
                $stmt->execute();

                foreach ($cartSongs as $item) {
                    Invoice::createInvoiceSongRelationship($con->lastInsertId(), $item['id']);
                    $total += $item['price'];
                }


                $db->disconnect($con);

                //return the invoice created
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            $stmt = null;
            $db->disconnect($con);
            return false;
        }
    }

    protected function createInvoiceSongRelationship($invoice_id, $song_id)
    {
        $db = new DB();
        $con = $db->connect();

        if ($con) {
            try {

                $stmt = $con->prepare("INSERT INTO `invoices_relationship` (`invoice_id`, `song_id`) VALUES ( :invoice_id, :song_id);");
                $stmt->bindParam(':invoice_id', $invoice_id);
                $stmt->bindParam(':song_id', $song_id);
                $stmt->execute();

                $db->disconnect($con);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            $stmt = null;
            $db->disconnect($con);
            return false;
        }
    }

    public function getSongBasedOnInvoice($invoice_id)
    {
        $db = new DB();
        $con = $db->connect();

        if ($con) {
            try {
                $stmt = $con->prepare("SELECT `song_id` FROM `invoices_relationship` WHERE `invoice_id` = :invoice_id");
                $stmt->bindParam(':invoice_id', $invoice_id);
                $stmt->execute();
                $result = $stmt->fetchAll();

                $db->disconnect($con);

                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            $stmt = null;
            $db->disconnect($con);
            return false;
        }
    }

    public function createInvoiceForUser($userId, $invoiceId)
    {
        $songIds = Invoice::getSongBasedOnInvoice($invoiceId);
        $songs = array();

        foreach ($songIds as $songId) {
            array_push($songs, Song::getSong($songId));
        }


        // invoice needs to contain the songs & the artist
        // invoice needs to contain the invoice number
        // invoice needs to contain the total amount of money

    }
}
