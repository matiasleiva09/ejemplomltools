<?php
class ModeloBA extends BusinessActionJSON
{
    private $modo="listar";
    private $modelo=null;
    public function __construct($xModelo=null,$xModo)
    {
       $this->modo=$xModo;
       $this->modelo=$xModelo;
    }

    public function accion()
    {
        if($this->modo=="listar")
        {
            $vSQL="select  momodelo as modelo, moidmodelo as id from modelo order by 1 asc";
            $this->setResultadoJSON($vSQL);
        }
        else if($this->modo=="combobox")
        {
            $vSQL="select  momodelo as valor, moidmodelo as iditem from modelo order by 1 asc";
            $this->setResultadoJSON($vSQL);
        }
        else if($this->modo=="encontrar")
        {
            $vSQL="select momodelo as modelo, moidmodelo as id from modelo where moidmodelo=".$this->modelo->getId();
            $res = Sql::encontrar($vSQL);
            if($res!=null)
              $this->modelo->setDescripcion($res["modelo"]);
        }
        else if($this->modo=="A")
        {
            $vSQL="insert into modelo (momodelo) values ('".$this->modelo->getDescripcion()."')";
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
            $vSQL="update modelo set momodelo='".$this->modelo->getDescripcion()."'";
            $vSQL.=" where moidmodelo=".$this->modelo->getId();
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
            $vSQL.="delete from modelo where moidmodelo=".$this->modelo->getId();
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

    public function getModelo()
    {
       return $this->modelo;
    }
}
?>