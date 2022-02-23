<?php
class MarcaBA extends BusinessActionJSON
{
    private $modo="listar";
    private $marca=null;
    public function __construct($xMarca=null,$xModo)
    {
       $this->modo=$xModo;
       $this->marca=$xMarca;
    }

    public function accion()
    {
        if($this->modo=="listar")
        {
            $vSQL="select  mamarca as marca, maidmarca as id from marca order by 1 asc";
            $this->setResultadoJSON($vSQL);
        }
        else if($this->modo=="combobox")
        {
            $vSQL="select  mamarca as valor, maidmarca as iditem from marca order by 1 asc";
            $this->setResultadoJSON($vSQL);
        }
        else if($this->modo=="encontrar")
        {
            $vSQL="select mamarca as marca, maidmarca as id from marca where maidmarca=".$this->marca->getId();
            $res = Sql::encontrar($vSQL);
            if($res!=null)
              $this->marca->setDescripcion($res["marca"]);
        }
        else if($this->modo=="A")
        {
            $vSQL="insert into marca (mamarca) values ('".$this->marca->getDescripcion()."')";
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
            $vSQL="update marca set mamarca='".$this->marca->getDescripcion()."'";
            $vSQL.=" where maidmarca=".$this->marca->getId();
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
            $vSQL.="delete from marca where maidmarca=".$this->marca->getId();
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

    public function getMarca()
    {
        return $this->marca;
    }
}
?>