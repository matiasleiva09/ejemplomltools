<?php
class ImagenProducto
{
    private $id=0;
    private $prioridad=0;
    private $archivo="";

    public function __construct($xId=0,$xPrioridad=0,$xArchivo)
    {
        $this->id=$xId;
        $this->prioridad=$xPrioridad;
        $this->archivo=$xArchivo;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($xId)
    {
        $this->id=$xId;
    }

    public function getPrioridad()
    {
        return $this->prioridad;
    }

    public function setPrioridad($xPrioridad)
    {
        $this->prioridad=$xPrioridad;
    }

    public function getArchivo()
    {
        return $this->archivo;
    }

    public function setArchivo($xArchivo)
    {
        $this->archivo=$xArchivo;
    }
}
?>