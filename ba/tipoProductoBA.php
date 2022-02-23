<?php
class TipoProductoBA extends BusinessActionJSON
{
    private $modo="listar";
    private $tipo=null;
    public function __construct($xTipo=null,$xModo)
    {
       $this->modo=$xModo;
       $this->tipo=$xTipo;
    }

    public function accion()
    {
        if($this->modo=="listar")
        {
            $vSQL="select tppadre as padre, tipo as tipo, tpidtipo as id from tipo_producto order by 1 asc";
            $this->setResultadoJSON($vSQL);
        }
        else if($this->modo=="encontrar")
        {
            $vSQL="select  tppadre as padre,tipo as tipo, tpidtipo as id from tipo_producto where tpidtipo=".$this->tipo->getId();
            $res=Sql::encontrar($vSQL);
            if($res!=null)
            {
                $this->tipo->setDescripcion($res["tipo"]);
                $this->tipo->setPadre($res["padre"]);
            }
               
        }
        else if($this->modo=="combobox")
        {
            $vSQL="select  tipo as valor, tpidtipo as iditem from tipo_producto order by 1 asc";
            $this->setResultadoJSON($vSQL);
        }
        else if($this->modo=="comboboxpadre")
        {
            $vSQL="select  tipo as valor, tpidtipo as iditem from tipo_producto where tppadre='' order by 1 asc";
            $this->setResultadoJSON($vSQL);
        }
        else if($this->modo=="A")
        {
            $vSQL="insert into tipo_producto (tipo,tppadre) values ('".$this->tipo->getDescripcion()."','".$this->tipo->getPadre()."')";
            try
            {
                Sql::ejecutar($vSQL);
                $this->setResultadoEstadoJSON(true);
            }
            catch(Exception $ex)
            {
                $this->setResultadoEstadoJSON(false);
            }
        }
        else if($this->modo=="B")
        {  
            $vSQL.="delete from tipo_producto where tpidtipo=".$this->tipo->getId();
            try
            {
                Sql::ejecutar($vSQL);
                $this->setResultadoEstadoJSON(true);
            }
            catch(Exception $ex)
            {
                $this->setResultadoEstadoJSON(false);
            }
        }
        else if($this->modo=="E")
        {
            $vSQL="update tipo_producto set tipo='".$this->tipo->getDescripcion()."'";
            $vSQL.=", tppadre='".$this->tipo->getPadre()."'";
            $vSQL.=" where tpidtipo=".$this->tipo->getId();
            try
            {
                Sql::ejecutar($vSQL);
                $this->setResultadoEstadoJSON(true);
            }
            catch(Exception $ex)
            {
                $this->setResultadoEstadoJSON(false);
            }
        }
        
        
    }

    public function getTipo()
    {
        return $this->tipo;
    }
}
?>