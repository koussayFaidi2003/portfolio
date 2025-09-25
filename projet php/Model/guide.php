<?php
class Guide
{
    private ?int $id = null;
    private ?string $specailite = null;

    public function __construct($id = null, $n)
    {
        $this->id = $id;
        $this->specailite= $n;
    }


    public function getIdguide()
    {
        return $this->id;
    }


    public function getspecailite()
    {
        return $this->specailite;
    }


    public function setspecailite($specailite)
    {
        $this->specailite = $specailite;

        return $this;
    }


}
