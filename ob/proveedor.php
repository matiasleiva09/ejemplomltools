<?php
class Proveedor extends Persona
{
    private $id=0;
    private $nombre="";



    public function  __construct($xId=0,$xNombre="",$xCuit="0-000000000-0",$xCondicioniva="CONSUMIDOR FINAL",$xTelefono="",$xEmail="",
    $xCelular="",$xCalle="",
    $xNro="",$xPiso="",$xDpto="",$xLocalidad="",$xProvincia="",$xCp="")
    {
          $this->setId($xId);
          $this->setNombre($xNombre);
          $this->setCuit($xCuit);
          $this->setTelefono($xTelefono);
          $this->setCelular($xCelular);
          $this->setEmail($xEmail);
          $this->setCalle($xCalle);
          $this->setNro($xNro);
          $this->setCondicionIVA($xCondicioniva);
          $this->setLocalidad($xLocalidad);
          $this->setProvincia($xProvincia);
          $this->setCp($xCp);
          $this->setDpto($xDpto);
          $this->setPiso($xPiso);
    }

    public function copy(Proveedor $xProveedor)
    {
        $this->setId($xProveedor->getId());
        $this->setNombre($xProveedor->getNombre());
        $this->setCuit($xProveedor->getCuit());
        $this->setCondicionIVA($xProveedor->getCondicionIVA());
        $this->setTelefono($xProveedor->getTelefono());
        $this->setCelular($xProveeodr->getCelular());
        $this->setEmail($xProveeodr->getEmail());
        $this->setCalle($xProveeodr->getCalle());
        $this->setPiso($xProveeodr->getPiso());
        $this->setDpto($xProveeodr->getDpto());
        $this->setLocalidad($xProveeodr->getLocalidad());
        $this->setProvincia($xProveeodr->getProvincia());
        $this->setCp($xProveeodr->getCp());
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($xId)
    {
        $this->id=$xId;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($xNombre)
    {
        $this->nombre=$xNombre;
    }

   
}
?>