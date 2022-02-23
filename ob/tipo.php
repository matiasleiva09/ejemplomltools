<?php
class Tipo
{
    private $id=0;
    private $descripcion="";

  /*  public function __construct($xId=0,$xDescripcion)
    {
        $this->id=$xId;
        $this->descripcion=$xDescripcion;
    }*/

    public function getId()
    {
        return $this->id;
    }

    public function setId($xId)
    {
        $this->id=$xId;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($xDescripcion)
    {
        $this->descripcion=$xDescripcion;
    }
}
?>