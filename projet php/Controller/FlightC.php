<?php

require "C:/xampp/htdocs/INTEG MALEK OUMA/config.php";
class FlightC
{

    public function listFlight()
    {
        $sql = "SELECT * FROM flight";

        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function listFlight2()
    {
        $sql = "SELECT * FROM flight";

        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteFlight($ide)
    {
        $sql = "DELETE FROM flight WHERE idFlight = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addFlight($Flight)
    {
        $sql = "INSERT INTO flight 
        VALUES (NULL, :lieuD,:lieuA,:dateD, :dateA,:numberp,:billet)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'lieuD' => $Flight->getlieuD(),
                'lieuA' => $Flight->getlieuA(),
                'dateD' => $Flight->getdateD(),
                'dateA' => $Flight->getdateA(),
                'numberp' => $Flight->getnumberp(),
                'billet' => $Flight->getbillet(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    function addFlight2($Flight)
    {
        $sql = "INSERT INTO flight 
        VALUES (NULL, :lieuD,:lieuA,:dateD, :dateA,:numberp,:billet)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'lieuD' => $Flight->getlieuD(),
                'lieuA' => $Flight->getlieuA(),
                'dateD' => $Flight->getdateD(),
                'dateA' => $Flight->getdateA(),
                'numberp' => $Flight->getnumberp(),
                'billet' => $Flight->getbillet(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function showFlight($id)
    {
        $sql = "SELECT * from flight where idFlight = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $Flight = $query->fetch();
            return $Flight;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateFlight($Flight, $id)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE flight SET 
                    lieuD = :lieuD, 
                    lieuA = :lieuA, 
                    dateD = :dateD,
                    dateA = :dateA, 
                    numberp = :numberp,
                    billet= :billet
                WHERE idFlight= :id'
            );
            
            $query->execute([
                'id' => $id,
                'lieuD' => $Flight->getlieuD(),
                'lieuA' => $Flight->getlieuA(),
                'dateD' => $Flight->getdateD(),
                'dateA' => $Flight->getdateA(),
                'numberp' => $Flight->getnumberp(),
                'billet'=> $Flight->getbillet(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    function updateFlight2($Flight, $id)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE flight SET 
                    lieuD = :lieuD, 
                    lieuA = :lieuA, 
                    dateD = :dateD,
                    dateA = :dateA, 
                    numberp = :numberp,
                    billet= :billet
                WHERE idFlight= :id'
            );
            
            $query->execute([
                'id' => $id,
                'lieuD' => $Flight->getlieuD(),
                'lieuA' => $Flight->getlieuA(),
                'dateD' => $Flight->getdateD(),
                'dateA' => $Flight->getdateA(),
                'numberp' => $Flight->getnumberp(),
                'billet'=> $Flight->getbillet(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}