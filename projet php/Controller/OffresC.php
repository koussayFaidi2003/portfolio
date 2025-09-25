<?PHP
	include "C:/xampp/htdocs/INTEG MALEK OUMA/config.php";
	include_once "C:/xampp/htdocs/tacheOffres/Model/Offres.php";

	class offresC {
        public function listOffres()
        {
            $sql = "SELECT * FROM offres";
    
            $db = config::getConnexion();//pdo
            try {
                $liste = $db->query($sql);//table des offres
                return $liste;
            } catch (Exception $e) {
                die('Error:' . $e->getMessage());
            }
        }
        function showavis($id)
    {
        $db = config::getConnexion();
        try {
            $query =$db->prepare("SELECT * from avis_offres where idoffre = :id");
            $query->execute(['id'=> $id]);
            return $query->fetchAll();
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
    function ajouterOffre($offre)
    {
        $sql = "INSERT INTO offres 
        VALUES (NULL,:nom_offre,:description_offree,:date_debut_validite, :date_fin_validite, :destination,:prix, :nombre_min_passagers)";       
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom_offre' => $offre->getNomOffre(),
                'description_offree' => $offre->getDescriptionOffre(),
                'date_debut_validite' => $offre->getDateDebutValidite(),
                'date_fin_validite' => $offre->getDateFinValidite(),
                'destination' => $offre->getDestination(),
                'prix' => $offre->getPrix(),
                'nombre_min_passagers' => $offre->getNombreMinPassagers()
            ]);		
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function supprimerOffre($id_off){
        $sql="DELETE FROM offres WHERE id_offre= :idoffre";
        $db = config::getConnexion();
        $req=$db->prepare($sql);
        $req->bindValue(':idoffre',$id_off);
        try{
            $req->execute();
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
    function modifierOffre(Offres $offre, int $id) {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE Offres SET 
                    nom_offre = :nom_offre, 
                    description_offre = :description_offre, 
                    date_debut_validite = :date_debut_validite, 
                    date_fin_validite = :date_fin_validite, 
                    destination = :destination,
                    prix = :prix, 
                    nombre_min_passagers = :nombre_min_passagers
                WHERE id_offre = :id'
            );
            
            $query->execute([
                'id' => $id,
                'nom_offre' => $offre->getNomOffre(),
                'description_offre' => $offre->getDescriptionOffre(),
                'date_debut_validite' => $offre->getDateDebutValidite(),
                'date_fin_validite' => $offre->getDateFinValidite(),
                'destination' => $offre->getDestination(),
                'prix' => $offre->getPrix(),
                'nombre_min_passagers' => $offre->getNombreMinPassagers()
            ]);
            
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo $e->getMessage(); // Afficher l'erreur en cas d'échec
        }
    }

    public function getLastAddedOffer() {
        // Connexion à la base de données
        $conn = new mysqli('localhost (127.0.0.1)', 'username', 'password', 'fantasydatabase');

        // Vérification des erreurs de connexion
        if ($conn->connect_error) {
            die("Erreur de connexion à la base de données : " . $conn->connect_error);
        }

        // Requête pour récupérer la dernière offre ajoutée
        $query = "SELECT * FROM offres ORDER BY id_offre DESC LIMIT 1";
        $result = $conn->query($query);

        // Vérification des erreurs de requête
        if (!$result) {
            die("Erreur de requête : " . $conn->error);
        }

        // Récupération des données de l'offre
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }

        return null;
    }
}