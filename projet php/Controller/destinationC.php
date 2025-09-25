<?php
include "C:/xampp/htdocs/INTEG MALEK OUMA/config.php";
class DestinationC
{

    public function listdistination()
    {
        $sql = "SELECT * FROM destination";

        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function deletedestination($id)
    {
        $sql = "DELETE FROM destination WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function adddestination($destination)
    {
        $sql = "INSERT INTO destination  
        VALUES (NULL,:pays, :ville)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'pays' => $destination->getpays(),
                'ville' => $destination->getville(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    function updatedestination($destination, $id)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE destination SET 
                    pays = :pays, 
                    ville = :ville
                WHERE id= :id'
            );
            
            $query->execute([
                'id' => $id,
                'pays' => $destination->getpays(),
                'ville' => $destination->getville(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
function showdestination($id)
{
    $sql = "SELECT * from destination where id = $id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute();
        $destination = $query->fetch();
        return $destination;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}


