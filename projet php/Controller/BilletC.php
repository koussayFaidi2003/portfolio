<?php

require "C:/xampp/htdocs/INTEG MALEK OUMA/config.php";

class BilletC
{

    public function listBillet()
    {
        $sql = "SELECT * FROM billet";

        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function listBillet2()
    {
        $sql = "SELECT * FROM billet";

        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteBillet($ide)
    {
        $sql = "DELETE FROM billet WHERE idBillet = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addBillet($Billet)
    {
        $sql = "INSERT INTO billet 
        VALUES (NULL, :flightNumber,:UserName,:Date_Purchase, :Seat_Number,:Price)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'flightNumber' => $Billet->getflightNumber(),
                'UserName' => $Billet->getUserName(),
                'Date_Purchase' => $Billet->getDate_Purchase(),
                'Seat_Number' => $Billet->getSeat_Number(),
                'Price' => $Billet->getPrice(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showBillet($id)
    {
        $sql = "SELECT * from billet where idBillet = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $Billet = $query->fetch();
            return $Billet;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateBillet($Billet, $id)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE billet SET 
                    flightNumber = :flightNumber, 
                    UserName = :UserName, 
                    Date_Purchase = :Date_Purchase,
                    Seat_Number = :Seat_Number, 
                    Price = :Price
                WHERE idBillet= :id'
            );
            
            $query->execute([
                'id' => $id,
                'flightNumber' => $Billet->getflightNumber(),
                'UserName' => $Billet->getUserName(),
                'Date_Purchase' => $Billet->getDate_Purchase(),
                'Seat_Number' => $Billet->getSeat_Number(),
                'Price' => $Billet->getPrice(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    public function afficherFlights($idBillet)
    {
        //$sql = "SELECT * from billet where idBillet = $id";
        
        try {
            $db = config::getConnexion();
            $query = $db->prepare("SELECT * FROM flight WHERE billet = :id");
            $query->execute(['id'=>$idBillet]);
            return $query->fetchAll();;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function afficherBillets()
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare("SELECT * FROM billet");
            $query->execute();
            return $query->fetchAll();;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}