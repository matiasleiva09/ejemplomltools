<?php
class TipoProducto extends Tipo
{
    private $padre="";

    public function getPadre()
    {
        return $this->padre;
    }

    public function setPadre($xPadre)
    {
        return $this->padre=$xPadre;
    }
}
?>