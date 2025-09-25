<?php
class Billet
{
    private ?int $idBillet = null;
    private ?int $flightNumber = null;
    private ?string $UserName = null;
    private ?string $Date_Purchase = null;
    private ?int $Seat_Number = null;
    private ?float $Price = null;
    

    public function __construct($id = null, $fn, $un, $dp, $sn, $p)
    {
        $this->idBillet = $id;
        $this->flightNumber = $fn;
        $this->UserName = $un;
        $this->Date_Purchase = $dp;
        $this->Seat_Number = $sn;
        $this->Price = $p;
    }


    public function getidBillet()
    {
        return $this->idBillet;
    }


    public function getflightNumber()
    {
        return $this->flightNumber;
    }


    public function setflightNumber($flightNumber)
    {
        $this->flightNumber= $flightNumber;

        return $this;
    }


    public function getUserName()
    {
        return $this->UserName;
    }


    public function setUserName($UserName)
    {
        $this->UserName = $UserName;

        return $this;
    }


    public function getDate_Purchase()
    {
        return $this->Date_Purchase;
    }


    public function setDate_Purchase($Date_Purchase)
    {
        $this->Date_Purchase = $Date_Purchase;

        return $this;
    }
    public function getSeat_Number()
    {
        return $this->Seat_Number;
    }


    public function setSeat_Number($Seat_Number)
    {
        $this->Seat_Number = $Seat_Number;

        return $this;
    }
    public function getPrice()
    {
        return $this->Price;
    }


    public function setPrice($Price)
    {
        $this->Price = $Price;

        return $this;
    }
   
    
}