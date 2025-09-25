<?php

class Commentaire
{
    private ?int $idC = null;
    private ?string $commentaire = null;
    private ?string $email = null;

    public function __construct($idC = null, $commentaire, $email)
    {
        $this->idC = $idC;
        $this->title = $commentaire;
        $this->content = $email;
    }

    public function getId()
    {
        return $this->idC;
    }

    public function getCommentaire()
    {
        return $this->commentaire;
    }

    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
        return $this;
    }

    public function getemail()
    {
        return $this->email;
    }

    public function setemail($email)
    {
        $this->email = $email;
        return $this;
    }
}