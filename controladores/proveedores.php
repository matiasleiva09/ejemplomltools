<?php
include("../core/daobase/Sql.php");
include("../core/babase/BusinessActionJSON.php");
$modo = $_POST["modo"];
if($modo=="listar")
{
    include("../ba/cargarProveedoresBA.php");
    $vBA = new CargarProveedoresBA();
    $vBA->realizar();
    echo $vBA->getResultadoJSON();
}
else if($modo =="A" || $modo=="E" || $modo=="B" || $modo=="combobox")
{
    include("../ob/Persona.php");
    include("../ob/proveedor.php");
    include("../ba/abmProveedorBA.php");
    $proveedor = new Proveedor($_POST["id"],$_POST["nombre"],$_POST["cuit"],$_POST["condicioniva"],$_POST["telefono"],$_POST["email"],
    $_POST["celular"],$_POST["calle"],$_POST["nro"],$_POST["piso"],$_POST["dpto"],$_POST["localidad"],$_POST["provincia"],$_POST["cp"]);
    $vBA = new AbmProveedorBA($proveedor,$modo);
    $vBA->realizar();
    echo $vBA->getResultadoJSON();
}
else
{
    echo '{"estado":"sin comando"}';
}
?>