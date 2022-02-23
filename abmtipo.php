<?php
include("sesion.php");
include("utilidades/Utils.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="core/js/bootstrap/js/typeahead.bundle.js"></script>
<script src="core/js/libiahtool/alert.js"></script>
<script src="core/js/libiahtool/input.js"></script>
<script src="core/js/libiahtool/comboBoxPopUp.js"></script>
<script src="core/js/libiahtool/ajax.js"></script>
<link rel="stylesheet" href="core/js/libiahtool/css/css.css">
<link rel="stylesheet" href="core/js/bootstrap/css/typeahead.css">
<link rel="stylesheet" href="core/js/bootstrap/css/bootstrap.css">
<?php
include("core/daobase/Sql.php");
include("core/babase/BusinessActionJSON.php");
include("ob/tipo.php");
include("ob/tipoProducto.php");
include("ba/tipoProductoBA.php");
$tipo=new TipoProducto();
if($_GET["tId"]!="")
{
    $tipo->setId($_GET["tId"]);
    $vBA = new TipoProductoBA($tipo,"encontrar");
    $vBA->realizar();
    $tipo=$vBA->getTipo();
    ?>
      <title>Editar Rubro: <?=$tipo->getId().": ".$tipo->getDescripcion()?> </title>
   <?php
}
else
{
   
    ?>
        <title>Agregar Nuevo Rubro</title>
    <?php
}
?>
<script language="javascript">
  $(document).ready(
   
     function()
     {
         var alerta = new Alert();
         alerta.id="alerta";

         var cmbpadre = new ComboBoxPopup();
         cmbpadre.construirRapido("Padre:","padre","cmbpadre","modo=comboboxpadre","controladores/tipo.php",false,true);
         cmbpadre.valor("<?=$tipo->getPadre()?>");

         var txttipo = new Input();
         txttipo.construirRapidoTexto("Rubro:","txttipo","tipo",true,"text",false,false,false);

     
         txttipo.valor("<?=$tipo->getDescripcion()?>");
        $("#btnguardar").click
        (
            function()
            {
                if(txttipo.obtenerValor()!="")
                {
                    var parametros="";
                    var id=<?=$tipo->getId()?>;
                    parametros="id="+id;
                    if(id > 0)
                        parametros+="&modo=E";
                    else
                        parametros+="&modo=A";
                    parametros+="&descripcion=" +txttipo.obtenerValor();
                    parametros+="&padre=" +cmbpadre.obtenerValor();
                    var ajax = new Ajax();
                    ajax.asincronico=false;
                    ajax.id="pResultado";
                    ajax.metodo="POST";
                    ajax.pagina="controladores/tipo.php";
                    ajax.parametros=parametros;
                    ajax.tipoDeDatos="json";
                    var resultado = ajax.obtenerDatos();
                  //  window.alert(resultado["estado"]);
                     if(resultado["estado"]=="ok")
                     {
                        if(id<=0)
                        {
                            if(sessionStorage.getItem("vengoDe")=="tipoproductos.php")
                            {
                                sessionStorage.removeItem("vengoDe");
                                window.location.href="tipoproductos.php";
                            }
                            else
                            {
                                window.location.href="menurubros.php";
                            }
                           
                        }
                        else
                        {
                            window.location.href="tipoproductos.php";
                        }

                     }
                     else
                     {
                        alerta.show("ERROR","Error!","Ha ocurrido un error inesperado");
                    } 
                }
                else
                {
                     alerta.show("ERROR","Atención!","Complete los campos marcados en rojo");
                }
            }
        );

        $("#btnsalir").click
        (
             function()
             {
                if(sessionStorage.getItem("vengoDe")=="tipoproductos.php")
                {
                    sessionStorage.removeItem("vengoDe");
                    window.location.href="tipoproductos.php";
                }
                else
                {
                     window.location.href="menurubros.php";
                }
             }
        );

     }
  );
</script>


</head>
<body>
<br />
<br />
<br />
<div class="container">
<?php
  
?>
<div id="alerta"></div>
<form action="" method="post" name="formP" id="formP">
<div class="page-header">
  <h1>Datos del Rubro</h1>
</div>
 <br />
   <div id="padre"></div>
   <div id="tipo"></div>

   <br />

  <button type="button" name="btnguardar" id="btnguardar" class="btn btn-primary btn-lg btn-block">Aceptar</button>
  <button type="button" name="btnsalir" id="btnsalir" class="btn btn-primary btn-lg btn-block">Salir</button>
</form>
</div>

</body>
</html>