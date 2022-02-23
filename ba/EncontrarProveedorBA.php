<?php
class EncontrarProveedorBA extends BusinessActionJSON
{
    private $proveedor = null;
    private $idBuscar=0;

    public function __construct($xId)
    {
        $this->idBuscar=$xId;
    }

    public function accion()
	{
        $vSQL="select prnombre,prcuit,prcondicioniva,prtelefono,prcelular,premail,prcalle,prnro,prpiso,prdpto,";
        $vSQL.="prlocalidad,prprovincia,prcp";
        $vSQL.=" from proveedor where pridproveedor=".$this->idBuscar;
        try
        {
             $res=Sql::encontrar($vSQL);
             if($res!=null)
             {
                 $this->proveedor = new Proveedor();
                 $this->proveedor->setId($this->idBuscar);
                 $this->proveedor->setNombre($res["prnombre"]);
                 $this->proveedor->setCuit($res["prcuit"]);
                 $this->proveedor->setCondicionIVA($res["prcondicioniva"]);
                 $this->proveedor->setTelefono($res["prtelefono"]);
                 $this->proveedor->setCelular($res["prcelular"]);
                 $this->proveedor->setEmail($res["premail"]);
                 $this->proveedor->setCalle($res["prcalle"]);
                 $this->proveedor->setNro($res["prnro"]);
                 $this->proveedor->setPiso($res["prpiso"]);
                 $this->proveedor->setDpto($res["prdpto"]);
                 $this->proveedor->setLocalidad($res["prlocalidad"]);
                 $this->proveedor->setProvincia($res["prprovincia"]);
                 $this->proveedor->setCp($res["prcp"]);
             }
        }
        catch(Exception $ex)
        {
             echo "Error!";
        }
        
    }

    public function getProveedor()
    {
        return $this->proveedor;
    }
}
?>