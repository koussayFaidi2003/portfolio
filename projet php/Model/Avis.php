<?php
class Avis
{
    private ?int $id_avis = null;
    private ?int $idoffre = null;
    private ?int $id_utilisateur = null;
    private ?int $note = null;
    private ?string $avis = null ;

    public function __construct($id_avis= null,?int $idoffre,?int $id_utilisateur, ?int $note, ?string $avis)
    {
        $this->id_avis = $id_avis;
        $this->idoffre = $idoffre;
        $this->id_utilisateur = $id_utilisateur;
        $this->note = $note;
        $this->avis = $avis;
    }


    public function getIdavis():?int{
        return $this->id_avis;
    }

    public function getIdOffre(): ?int {
        return $this->idoffre;
    }

    public function getIdUtilisateur(): ?int {
        return $this->id_utilisateur;
    }

    public function getNote(): ?int {
        return $this->note;
    }

    public function getAvis(): ?string {
        return $this->avis;
    }

    public function setIdOffre(?int $idoffre)
    {
        $this->idoffre = $idoffre;
    }

    public function setIdUtilisateur(?int $id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;
    }

    public function setNote(?int $note)
    {
        $this->note = $note;
    }

    public function setAvis(?string $avis)
    {
        $this->avis = $avis;
    }
}