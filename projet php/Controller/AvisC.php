<?PHP
include "C:/xampp/htdocs/INTEG MALEK OUMA/config.php";
class AvisC
{

    public function listavis()
    {
        $sql = "SELECT * FROM avis_offres";

        $db = config::getConnexion();//pdo
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function supprimeravis($ide)
    {
        $sql = "DELETE FROM avis_offres WHERE  id_avis = :ide";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':ide', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function ajouteravis($Avis)
    {
        $sql = "INSERT INTO avis_offres VALUES (NULL,:idoffre, :id_utilisateur,:note,:avis)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'idoffre' => $Avis->getIdOffre(),
                'id_utilisateur' => $Avis->getIdUtilisateur(),
                'note' => $Avis->getNote(),
                'avis' => $Avis->getAvis(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function showavis($id)
    {
        $sql = "SELECT * FROM avis_offres WHERE id_avis = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $Avis = $query->fetch();
            return $Avis;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }   
    }

    function showOffres($idoffre)
        {
            $db = config::getConnexion();
            try {
                $query =$db->prepare("SELECT * from offres");
                $query->execute();
                $Offres = $query->fetchAll();
                return $Offres;
            } catch (Exception $e) {
                die('Error: ' . $e->getMessage());
            }
        }
        
    function modifieravis($Avis, $id)
    {   
    try {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE avis_offres SET 
             idoffre = :idoffre,
             id_utilisateur = :id_utilisateur,
             note = :note,
             avis = :avis
            WHERE id_avis = :id'
        );
        
        $query->execute([
            'id_avis' => $id,
            'idoffre' => $Avis->getIdOffre(),
            'id_utilisateur' => $Avis->getIdUtilisateur(),
            'note' => $Avis->getNote(),
            'avis' => $Avis->getAvis(),
        ]);
        
        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }   
    }
}