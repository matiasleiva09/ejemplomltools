<?php
include("../core/daobase/Sql.php");
include("../core/babase/BusinessActionJSON.php");
include("../ob/Tipo.php");
include("../ob/Modelo.php");
$modo = $_POST["modo"];
if($modo=="listar" || $modo=="combobox" )
{
    include("../ba/modeloBA.php");
    $vBA = new modeloBA(null,$modo);
    $vBA->realizar();
    echo $vBA->getResultadoJSON();
}
else if($modo =="A" || $modo=="E" || $modo=="B" || $modo=="encontrar")
{

    include("../ba/modeloBA.php");
    $marca = new Modelo();
    $marca->setId($_POST["id"]);
    $marca->setDescripcion($_POST["descripcion"]);
    $vBA = new ModeloBA($marca,$modo);
    $vBA->realizar();
    echo $vBA->getResultadoJSON();
}
else
{
    echo '{"estado":"sin comando"}';
}
?>