<?php
class EncontrarProductoBA extends BusinessActionJSON
{
    private $id=0;
    private $producto=null;

    public function __construct($xId)
    {
        $this->id=$xId;
    }

    public function accion()
    {
        $vSQL="select p.primagen as imagen,p.pridproducto as id,";
        $vSQL.=" p.prcodigo as codigo, p.prnombre as nombre,";
        $vSQL.=" p.prdescripcion as descripcion,pridproveedor as idproveedor,";
        $vSQL.=" p.prrubro as rubro,p.prmarca as marca,p.prstockactual as stock,";
        $vSQL.=" p.prstockminimo as stockminimo,p.prcostototal as costototal,";
        $vSQL.=" p.prprecioventa as precioventa";
        $vSQL.=" from producto as p";
        $vSQL.=" where p.prfechabaja is null and p.pridproducto=".$this->id;
        $vSQL.=" order by p.prnombre asc;";
        $resultado = Sql::encontrar($vSQL);
        if($resultado!=null)
        {
            $this->producto = new Producto($resultado["id"],$resultado["nombre"],$resultado["codigo"],
            $resultado["descripcion"],null,null,
            $resultado["idproveedor"],$resultado["marca"],$resultado["rubro"],$resultado["stock"],
            $resultado["stockminimo"],$resultado["costototal"],$resultado["precioventa"],$resultado["imagen"],array());
            $vSQL="";
            $vSQL="select ipidimagen,ipidproducto,iporden,iparchivo from imagen_producto";
            $vSQL.=" where ipidproducto=".$resultado["id"];
            $vSQL.=" order by iporden asc";
            $imgs=Sql::consultar($vSQL);
            if($imgs!=null)
            {
                $vImagenes = array();
                for($i=0;$i<count($imgs);$i++)
                {
                    array_push($vImagenes,new ImagenProducto($imgs[$i]["ipidimagen"],$imgs[$i]["iporden"],$imgs[$i]["iparchivo"]));
                    $this->producto->setImagenes($vImagenes);
                }
                  
                
            }
        }
    }

    public function getProducto()
    {
        return $this->producto;
    }
}
?>