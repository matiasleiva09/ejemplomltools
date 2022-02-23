<?php
class Persona
{
    public const CONSUMIDOR_FINAL="CONSUMIDOR FINAL";
    public const RESPONSABLE_INSCRIPTO="RESPONSABLE INSCRIPTO";
    public const EXCENTO="EXCENTO";
    public const MONOTRIBUTISTA="MONOTRIBUTISTA";

    private $cuit="0-000000000-0";
    private $condicioniva ="CONSUMIDOR FINAL";
    private $telefono="";
    private $email="";
    private $celular="";
    private $calle="";
    private $nro="";
    private $piso="";
    private $dpto="";
    private $localidad="";
    private $provincia="";
    private $cp="";


    public function getCuit()
    {
        return $this->cuit;
    }

    public function setCuit($xCuit)
    {
        $this->cuit=$xCuit;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($xTelefono)
    {
        $this->telefono=$xTelefono;
    }

    public function getCelular()
    {
        return $this->celular;
    }

    public function setCelular($xCelular)
    {
        $this->celular=$xCelular;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($xEmail)
    {
        $this->email=$xEmail;
    }


    public function getCondicionIVA()
    {
        return $this->condicioniva;
    }

    public function setCondicionIVA($xcondicioniva)
    {
        $this->condicioniva=$xcondicioniva;
    }

    public function getCalle()
    {
        return $this->calle;
    }

    public function setCalle($xCalle)
    {
        $this->calle=$xCalle;
    }

    public function getNro()
    {
        return $this->nro;
    }

    public function setNro($xNro)
    {
        $this->nro=$xNro;
    }

    public function getPiso()
    {
        return $this->piso;
    }

    public function setPiso($xPiso)
    {
        $this->piso=$xPiso;
    }

    public function getDpto()
    {
        return $this->dpto;
    }

    public function setDpto($xDpto)
    {
        $this->dpto=$xDpto;
    }

    public function getLocalidad()
    {
        return $this->localidad;
    }

    public function setLocalidad($xLocalidad)
    {
        $this->localidad=$xLocalidad;
    }


    public function getProvincia()
    {
        return $this->provincia;
    }

    public function setProvincia($xProvincia)
    {
        $this->provincia=$xProvincia;
    }

    public function getCp()
    {
        return $this->cp;
    }

    public function setCp($xCp)
    {
        $this->cp=$xCp;
    }
}
?>