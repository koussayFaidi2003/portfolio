<?php
class Flight
{
    private ?int $idFlight = null;
    private ?string $lieuD = null;
    private ?string $lieuA = null;
    private ?string $dateD = null;
    private ?string $dateA = null;
    private ?string $numberp = null;
    private ?int $billet = null;

    public function __construct($id = null, $ld, $la, $dD, $dA, $np, $b)
    {
        $this->idFlight = $id;
        $this->lieuD = $ld;
        $this->lieuA = $la;
        $this->dateD = $dD;
        $this->dateA = $dA;
        $this->numberp = $np;
        $this->billet = $b;
    }


    public function getIdFlight()
    {
        return $this->idFlight;
    }


    public function getlieuD()
    {
        return $this->lieuD;
    }


    public function setlieuD($lieuD)
    {
        $this->lieuD= $lieuD;

        return $this;
    }


    public function getlieuA()
    {
        return $this->lieuA;
    }


    public function setlieuA($lieuA)
    {
        $this->lieuA = $lieuA;

        return $this;
    }


    public function getdateD()
    {
        return $this->dateD;
    }


    public function setdateD($dateD)
    {
        $this->dateD = $dateD;

        return $this;
    }
    public function getdateA()
    {
        return $this->dateA;
    }


    public function setdateA($dateA)
    {
        $this->dateA = $dateA;

        return $this;
    }
    public function getnumberp()
    {
        return $this->numberp;
    }


    public function setnumberp($numberp)
    {
        $this->numberp = $numberp;

        return $this;
    }
    public function getbillet()
    {
        return $this->billet;
    }


    public function setbillet($billet)
    {
        $this->billet = $billet;

        return $this;
    }
    
}