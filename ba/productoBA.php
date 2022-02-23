<?php
class ProductoBA extends BusinessActionJSON
{
    private $modo="listar";
    private $producto=null;
    private $imagenes=null;

    public function __construct($xProducto=null,$xModo="listar")
    {
        $this->modo=$xModo;
        $this->producto=$xProducto;
    }

    public function accion()
    {
         if($this->modo=="listar")
          {
               $vSQL="select p.primagen,p.pridproducto as id,";
               $vSQL.=" p.prcodigo as codigo, p.prnombre as nombre,";
               $vSQL.=" p.prdescripcion as descripcion,pvee.prnombre as proveedor,";
               $vSQL.=" p.prrubro as rubro,p.prmarca as marca,p.prstockactual as stock,";
               $vSQL.=" p.prstockminimo as stockminimo,p.prcostototal as costototal,";
               $vSQL.=" p.prprecioventa as precioventa";
               $vSQL.=" from producto as p";
               $vSQL.=" left join proveedor pvee on pvee.pridproveedor =p.pridproveedor";
               $vSQL.=" where p.prfechabaja is null";
               $vSQL.=" order by p.prnombre asc;";
               $this->setResultadoJSON($vSQL);
          }
          else if($this->modo=="encontrar")
          {
               $vSQL="select  tipo as tipo, tpidtipo as id from tipo_producto where tpidtipo=".$this->proveedor->getId();
               $res=Sql::encontrar($vSQL);

          }
          else if($this->modo=="A")
          {
              try
              {
                    $vSQL="insert into producto (prnombre,prcodigo,primagen,prdescripcion,pridproveedor,prfechaingresado";
                    $vSQL.=",prrubro,prmarca,prstockactual,prstockminimo,prcostototal,prprecioventa)";
                    $vSQL.=" values ('".$this->producto->getNombre()."',";
                    $vSQL.="'".$this->producto->getCodigo()."','".$this->producto->getImagen()."','".$this->producto->getDescripcion()."',".$this->producto->getProveedor()->getId().",";
                    $vSQL.="current_date,'".$this->producto->getRubro()."','".$this->producto->getMarca()."',".$this->producto->getStock().",".$this->producto->getStockMinimo();
                    $vSQL.=",".$this->producto->getCostoTotal().",".$this->producto->getPrecioVenta().")";
                    Sql::ejecutar($vSQL);
               
                    $vSQL="";
                    $vSQL="select pridproducto from producto where prcodigo='". $this->producto->getCodigo()."'";
                    $vQuery=Sql::encontrar($vSQL);
                    if($vQuery!=null && count($this->producto->getImagenes()) > 0)
                    {
                        for($i=0;$i< count($this->producto->getImagenes());$i++)
                        {
                            $vSQL="insert into imagen_producto (ipidproducto,iporden,iparchivo)";
                            $vSQL.=" values (".$vQuery["pridproducto"].",".$this->producto->getImagenes()[$i]->getPrioridad();
                            $vSQL.=",'".$this->producto->getImagenes()[$i]->getArchivo()."')";
                            Sql::ejecutar($vSQL);
                        }
                    } 
                    $this->setResultadoEstadoJSON(true);  
              }
              catch(Exception $ex)
              {
                  $this->setResultadoEstadoJSON(false);
              }
            
          }
          else if($this->modo=="E")
          {
             $vSQL="update producto set";
             $vSQL.=" prnombre='".$this->producto->getNombre()."',";
             $vSQL.=" prcodigo='".$this->producto->getCodigo()."',";
             $vSQL.=" primagen='".$this->producto->getImagen()."',";
             $vSQL.=" prdescripcion='".$this->producto->getDescripcion()."',";
             $vSQL.=" pridproveedor='".$this->producto->getProveedor()->getId()."',";
             $vSQL.=" prrubro='".$this->producto->getRubro()."',";
             $vSQL.=" prmarca='".$this->producto->getMarca()."',";
             $vSQL.=" prstockactual='".$this->producto->getStock()."',";
             $vSQL.=" prstockminimo='".$this->producto->getStockMinimo()."',";
             $vSQL.=" prcostototal='".$this->producto->getCostoTotal()."',";
             $vSQL.=" prprecioventa='".$this->producto->getPrecioVenta()."'";
             $vSQL.=" where pridproducto=".$this->producto->getId();
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
             $vSQL="update producto set";
             $vSQL.=" prfechabaja=current_date";
             $vSQL.=" where pridproducto=".$this->producto->getId();
             try
             {
                Sql::ejecutar($vSQL);
                $vSQL="";
                $vSQL="select primagen from producto where pridproducto=".$this->producto->getId();
                $imagen=Sql::encontrar($vSQL);
                if($imagen!=null)
                    unlink("../../imagenes/".$imagen["primagen"]);              
                $vSQL="select iparchivo from imagen_producto where ipidproducto=".$this->producto->getId();
                $imagenes=Sql::consultar($vSQL);
                if($imagenes!=null)
                {
                    for($i=0;$i<count($imagenes);$i++)
                         unlink("../../imagenes/".$imagenes[$i]["iparchivo"]);
                    $vSQL="delete from imagen_producto where ipidproducto=".$this->producto->getId();
                    Sql::ejecutar($vSQL);
                }
                $this->setResultadoEstadoJSON(true);
             }
             catch(Exception $ex)
             {
                $this->setResultadoEstadoJSON(false);
             }
          }
    }

    public function getProducto()
    {
        return $this->producto;
    }
}
?>