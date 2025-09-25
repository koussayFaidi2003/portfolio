<?PHP
class Offres {
    private ?int $id_offre;
    private string $nom_offre;
    private string $description_offre;
    private string $date_debut_validite;
    private string $date_fin_validite;
    private ?string $destination; // Peut être NULL
    private ?float $prix;
    private ?int $nombre_min_passagers; // Peut être NULL

    public function __construct($id_offre = null,string $nom_offre,string $description_offre,string $date_debut_validite,string $date_fin_validite,?string $destination,?float $prix,?int $nombre_min_passagers) {
        $this->id_offre = $id_offre;
        $this->nom_offre = $nom_offre;
        $this->description_offre = $description_offre;
        $this->date_debut_validite = $date_debut_validite;
        $this->date_fin_validite = $date_fin_validite;
        $this->destination = $destination;
        $this->prix = $prix;
        $this->nombre_min_passagers = $nombre_min_passagers;
    }


    public function getIdOffre(): ?int {
        return $this->id_offre;
    }

    public function getNomOffre(): ?string {
        return $this->nom_offre;
    }

    public function getDescriptionOffre(): ?string {
        return $this->description_offre;
    }

    public function getDateDebutValidite(): ?string {
        return $this->date_debut_validite;
    }

    public function getDateFinValidite(): ?string {
        return $this->date_fin_validite;
    }

    public function getDestination(): ?string {
        return $this->destination;
    }
    public function getPrix(): ?float {
        return $this->prix;
    }
    public function getNombreMinPassagers(): ?int {
        return $this->nombre_min_passagers;
    }

    public function setNomOffre(string $nom_offre) {
        $this->nom_offre = $nom_offre;
    }

    public function setDescriptionOffre(string $description_offre) {
        $this->description_offre = $description_offre;
    }

    public function setDateDebutValidite(?DateTime $date_debut_validite) {
        $this->date_debut_validite = $date_debut_validite;
    }

    public function setDateFinValidite(?DateTime $date_fin_validite) {
        $this->date_fin_validite = $date_fin_validite;
    }

    public function setDestination(?string $destination) {
        $this->destination = $destination;
    }
    public function setPrix(?float $prix) {
        $this->prix = $prix;
    }
    public function setNombreMinPassagers(?int $nombre_min_passagers) {
        $this->nombre_min_passagers = $nombre_min_passagers;
    }
}
?>