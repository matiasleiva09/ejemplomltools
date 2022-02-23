<?php
class Usuario
{
    private $id=0;
    private $nombre="";
    private $contrasena="";
    private $descripcion="";
    private $activado=true;

    public function getId()
    {
        return $this->id;
    }

    public function setId($xId)
    {
        $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setDescripcion($xDescripcion)
    {
        $this->descripcion;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($xDescripcion)
    {
        $this->descripcion;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function setActivo($xActivo)
    {
        $this->activado;
    }
}
?>