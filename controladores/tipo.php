<?php
include("../core/daobase/Sql.php");
include("../core/babase/BusinessActionJSON.php");
include("../ob/Tipo.php");
include("../ob/TipoProducto.php");
$modo = $_POST["modo"];
if($modo=="listar"  || $modo=="combobox" || $modo=="comboboxpadre")
{
    include("../ba/tipoProductoBA.php");
    $vBA = new TipoProductoBA(null,$modo);
    $vBA->realizar();
    echo $vBA->getResultadoJSON();
}
else if($modo =="A" || $modo=="E" || $modo=="B" || $modo=="encontrar")
{

    include("../ba/tipoProductoBA.php");
    $tipo = new TipoProducto();
    $tipo->setId($_POST["id"]);
    $tipo->setDescripcion($_POST["descripcion"]);
    $tipo->setPadre($_POST["padre"]);
    $vBA = new TipoProductoBA($tipo,$modo);
    $vBA->realizar();
    echo $vBA->getResultadoJSON();
}
else
{
    echo '{"estado":"sin comando"}';
}
?>