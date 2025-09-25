<?php
class user
{
    private ?int $iduser = null;
    private ?string $nom = null;
    private ?string $prenom = null;
    private ?string $email = null;
    private ?string $psw = null;
    private ?string $tel = null;

    public function __construct($id = null, $n, $p, $a, $d, $ps)
    {
        $this->iduser = $id;
        $this->nom = $n;
        $this->prenom = $p;
        $this->email = $a;
        $this->psw = $ps;
        $this->tel = $d;
    }


    public function getIduser()
    {
        return $this->iduser;
    }


    public function getNom()
    {
        return $this->nom;
    }


    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }


    public function getPrenom()
    {
        return $this->prenom;
    }


    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    public function getpsw()
    {
        return $this->psw;
    }


    public function setpsw($psw)
    {
        $this->psw = $psw;

        return $this;
    }


    public function getTel()
    {
        return $this->tel;
    }


    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }
}
