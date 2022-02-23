<?php
class CargarProveedoresBA extends BusinessActionJSON
{
    public function accion()
	{
        $vSQL="";
        $vSQL="select pridproveedor as id,";
        $vSQL.=" prnombre as nombre, prcuit as cuit,";
        $vSQL.=" prcondicioniva as condicioniva,prtelefono as telefono,";
        $vSQL.=" prcelular as celular,premail as email,";
        $vSQL.=" concat('Calle: ' , prcalle , ', Nro: ' , prnro , ', Piso: ', prpiso , ', Dpto: ', prdpto, ', Localidad: ',";
        $vSQL.=" prlocalidad , ', Provincia: ' , prprovincia  , ', CP: ', prcp ) as direccion";
        $vSQL.=" from proveedor order by prnombre asc";
        $this::setResultadoJSON($vSQL);    
    }
}
?>

