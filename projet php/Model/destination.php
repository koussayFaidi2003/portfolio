<?php
class Destination
{
    private ?int $id = null;
    private ?string $pays = null;
    private ?string $ville = null;
    public function __construct($id = null, $p, $v)
    {
        $this->id= $id;
        $this->pays = $p;
        $this->ville = $v;
       
    }
    public function getIddestination()
    {
        return $this->id;
    }


    public function getpays()
    {
        return $this->pays;
    }


    public function setpays($pays)
    {
        $this->pays = $pays;

        return $this;
    }


    public function getville()
    {
        return $this->ville;
    }


    public function setville($ville)
    {
        $this->ville = $ville;

        return $this;
    }
    
}
