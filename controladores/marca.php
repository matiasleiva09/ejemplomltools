<?php
include("../core/daobase/Sql.php");
include("../core/babase/BusinessActionJSON.php");
include("../ob/Tipo.php");
include("../ob/Marca.php");
$modo = $_POST["modo"];
if($modo=="listar" ||$modo=="combobox" )
{
    include("../ba/marcaBA.php");
    $vBA = new marcaBA(null,$modo);
    $vBA->realizar();
    echo $vBA->getResultadoJSON();
}
else if($modo =="A" || $modo=="E" || $modo=="B" || $modo=="encontrar")
{

    include("../ba/marcaBA.php");
    $marca = new Marca();
    $marca->setId($_POST["id"]);
    $marca->setDescripcion($_POST["descripcion"]);
    $vBA = new marcaBA($marca,$modo);
    $vBA->realizar();
    echo $vBA->getResultadoJSON();
}
else
{
    echo '{"estado":"sin comando"}';
}
?>