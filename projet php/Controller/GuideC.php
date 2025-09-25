<?php

include "C:/xampp/htdocs/INTEG MALEK OUMA/config.php";

class GuideC
{

    public function afficherdistination($id)
    {
        try {
            $pdo = config::getConnexion();
            $query = $pdo->prepare("SELECT * FROM destination WHERE guide = :id");
            $query ->execute(['id' =>$id]);
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function afficherguide()
{
    try {
        $pdo = config::getConnexion();
        $query = $pdo->prepare("SELECT * FROM guide");
        $query->execute();
        return $query->fetchAll();
    } catch (PDOException $e) {
        die('error: ' . $e->getMessage());
    }
}
    public function listguide()
    {
        $sql = "SELECT * FROM guide";

        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteguide($id)
    {
        $sql = "DELETE FROM guide WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addguide($guide)
    {
        $sql = "INSERT INTO guide  (specailite) 
        VALUES (:specailite)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'specailite' => $guide->getspecailite(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showguide($id)
    {
        $sql = "SELECT * from guide where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $guide = $query->fetch();
            return $guide;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateguide($guide, $id)
    {   
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE guide SET 
                    specailite = :specailite
                WHERE id= :id'
            );
            
            $query->execute([
                'id' => $id,
                'specailite' => $guide->getspecailite(),
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
  function listRatings($input)
    {
        $sql = "SELECT * FROM guide WHERE id = $input";
        $db = config::getConnexion();
        
        try {
            $liste = $db->query($sql);
            
            // Construisez des objets Guide à partir des données récupérées de la base de données
            $ratings = array();
            foreach ($liste as $row) {
                $guide = new Guide(
                    $row['id'],
                    $row['specialties']
                );
                $ratings[] = $guide;
            }
            
            return $ratings;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function modifierguide($guide, $id){
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE guide SET 
                id = :id,
                specailite=:specailite

                WHERE id = :id'
            );
            $query->execute([
                'id' => $id,
                'specailite' => $guide->getspecailite()
                
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
