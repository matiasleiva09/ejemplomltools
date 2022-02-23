<?php
class AbmProveedorBA extends BusinessActionJSON
{
     private $proveedor=null;
     private $modo="A";
     private $correcto=true;
   
     public function __construct($xProveedor,$xModo)
     {
         $this->proveedor=$xProveedor;
         $this->modo=$xModo;
     }

    public function accion()
    {
          if($this->modo=="A")
          {
                $vSQL="insert into proveedor (prnombre,prcuit,prcondicioniva,prtelefono,prcelular,premail,prcalle,prnro,prpiso,prdpto,";
                 $vSQL.="prlocalidad,prprovincia,prcp)";
                 $vSQL.=" values (";
                // $vSQL.=":nombre,:cuit,:condicioniva,:telefono,:celular,:email,:calle,:nro,:piso,:dpto,:localidad,:provincia,:cp)";
                $vSQL.="'".$this->proveedor->getNombre()."',";
                $vSQL.="'".$this->proveedor->getCuit()."',";
                $vSQL.="'".$this->proveedor->getCondicionIVA()."',";
                $vSQL.="'".$this->proveedor->getTelefono()."',";
                $vSQL.="'".$this->proveedor->getCelular()."',";
                $vSQL.="'".$this->proveedor->getEmail()."',";
                $vSQL.="'".$this->proveedor->getCalle()."',";
                $vSQL.="'".$this->proveedor->getNro()."',";
                $vSQL.="'".$this->proveedor->getPiso()."',";
                $vSQL.="'".$this->proveedor->getDpto()."',";
                $vSQL.="'".$this->proveedor->getLocalidad()."',";
                $vSQL.="'".$this->proveedor->getProvincia()."',";
                $vSQL.="'".$this->proveedor->getCp()."');";
                 try
                 {
                  /* $parametros = array("nombre"=>$this->proveedor->getNombre(),
                  "cuit"=> $this->proveedor->getCuit(),"piso" => $this->proveedor->getPiso(),
                  "condicioniva" => $this->proveedor->getCondicionIVA(),"dpto" => $this->proveedor->getDpto(),
                   "calle" => $this->proveedor->getCalle(),"nro" => $this->proveedor->getNro(),"localidad"=> $this->proveedor->getLocalidad(),
                  "provincia" => $this->proveedor->getProvincia(),"cp" => $this->proveedor->getCp(),"telefono" => $this->proveedor->getTelefono(),
                  "celular" => $this->proveedor->getCelular(),"email" => $this->proveedor->getEmail());
                   Sql::ejecutarParametros($vSQL,$parametros);*/
                   Sql::ejecutar($vSQL);
                   $this->setResultadoEstadoJSON(true);
                 }
                 catch(Exception $ex)
                 {
                   $this->correcto=false;
                   $this->setResultadoEstadoJSON(false);
                 }
          }
          else if($this->modo=="E")
          {
            
            $vSQL="update proveedor set";
            $vSQL.=" prnombre='".$this->proveedor->getNombre()."',";
            $vSQL.="prcuit='".$this->proveedor->getCuit()."',";
            $vSQL.="prcondicioniva='".$this->proveedor->getCondicionIVA()."',";
            $vSQL.="prtelefono='".$this->proveedor->getTelefono()."',";
            $vSQL.="prcelular='".$this->proveedor->getCelular()."',";
            $vSQL.="premail='". $this->proveedor->getEmail()."',";
            $vSQL.="prcalle='".$this->proveedor->getCalle()."',";
            $vSQL.="prnro='". $this->proveedor->getNro()."',";
            $vSQL.="prpiso='". $this->proveedor->getPiso()."',";
            $vSQL.="prdpto='".$this->proveedor->getDpto()."',";
            $vSQL.="prlocalidad='".$this->proveedor->getLocalidad()."',";
            $vSQL.="prprovincia='".$this->proveedor->getProvincia()."',";
            $vSQL.="prcp='".$this->proveedor->getCp()."'";
            $vSQL.=" WHERE pridproveedor=".$this->proveedor->getId();
            try
            {
            /*  $parametros = array(":nombre"=>$this->proveedor->getNombre(),
                  ":cuit"=> $this->proveedor->getCuit(),":piso" => $this->proveedor->getPiso(),
                  ":condicioniva" => $this->proveedor->getCondicionIVA(),":dpto" => $this->proveedor->getDpto(),
                   ":calle" => $this->proveedor->getCalle(),":nro" => $this->proveedor->getNro(),":localidad"=> $this->proveedor->getLocalidad(),
                  ":provincia" => $this->proveedor->getProvincia(),":cp" => $this->proveedor->getCp(),":telefono" => $this->proveedor->getTelefono(),
                  ":celular" => $this->proveedor->getCelular(),":email" => $this->proveedor->getEmail(),":id"=>$this->proveedor->getId());
            
               Sql::ejecutarParametros($vSQL,$parametros);*/
               Sql::ejecutar($vSQL);
               $this->setResultadoEstadoJSON(true);
            }
            catch(Exception $ex)
            {
              $this->correcto=false;
              $this->setResultadoEstadoJSON(false);
            }
          }
          else if($this->modo=="B")
          {
            $vSQL="delete from proveedor";
            $vSQL.=" where pridproveedor=:id";
            try
            {
               $parametros = array();
               $parametros["id"] = $this->proveedor->getId();
               Sql::ejecutarParametros($vSQL,$parametros);
               $this->setResultadoEstadoJSON(true);
            }
            catch(Exception $ex)
            {
               $this->correcto=false;
               $this->setResultadoEstadoJSON(false);
            }
          }
          else if($this->modo=="combobox")
          {
            $vSQL="select prnombre  as valor, pridproveedor as iditem from proveedor order by 1 asc";
            $this->setResultadoJSON($vSQL);
          }
    }

    public function getEjecutoBien()
    {
       return $this->correcto;
    }
}
?>