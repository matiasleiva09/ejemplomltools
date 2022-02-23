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
<script src="core/js/libiahtool/alert.js"></script>
<script src="core/js/libiahtool/input.js"></script>
<script src="core/js/libiahtool/comboBox.js"></script>
<script src="core/js/libiahtool/ajax.js"></script>
<link rel="stylesheet" href="core/js/bootstrap/css/bootstrap.css">
<?php
include("core/daobase/Sql.php");
include("core/babase/BusinessActionJSON.php");
include("ob/tipo.php");
include("ob/modelo.php");
include("ba/modeloBA.php");
$modelo=new Modelo();
if($_GET["mId"]!="")
{
    $modelo->setId($_GET["mId"]);
    $vBA = new ModeloBA($modelo,"encontrar");
    $vBA->realizar();
    $modelo=$vBA->getModelo();
    ?>
      <title>Editar Modelo: <?=$modelo->getId().": ".$modelo->getDescripcion()?> </title>
   <?php
}
else
{
   
    ?>
        <title>Agregar Nuevo Modelo</title>
    <?php
}
?>
<script language="javascript">
  $(document).ready(
   
     function()
     {
         var alerta = new Alert();
         alerta.id="alerta";
         var txtmodelo = new Input();
        txtmodelo.construirRapidoTexto("Modelo:","txtmodelo","modelo",true,"text",false,false,false);

     
        txtmodelo.valor("<?=$modelo->getDescripcion()?>");
        $("#btnguardar").click
        (
            function()
            {
                if(txtmodelo.obtenerValor()!="")
                {
                    var parametros="";
                    var id=<?=$modelo->getId()?>;
                    parametros="id="+id;
                    if(id > 0)
                        parametros+="&modo=E";
                    else
                        parametros+="&modo=A";
                    parametros+="&descripcion=" +txtmodelo.obtenerValor();
                    //window.alert(parametros);
                    var ajax = new Ajax();
                    ajax.asincronico=false;
                    ajax.id="pResultado";
                    ajax.metodo="POST";
                    ajax.pagina="controladores/modelo.php";
                    ajax.parametros=parametros;
                    ajax.tipoDeDatos="json";
                    var resultado = ajax.obtenerDatos();
                  //  window.alert(resultado["estado"]);
                     if(resultado["estado"]=="ok")
                     {
                        if(id<=0)
                        {
                            if(sessionStorage.getItem("vengoDeModelo")=="modelo.php")
                            {
                                sessionStorage.removeItem("vengoDeModelo");
                                window.location.href="modelo.php";
                            }
                            else
                            {
                                window.location.href="menup.php";
                            }
                           
                        }
                        else
                        {
                            window.location.href="modelo.php";
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
                if(sessionStorage.getItem("vengoDeModelo")=="modelo.php")
                {
                    sessionStorage.removeItem("vengoDeModelo");
                    window.location.href="modelo.php";
                }
                else
                {
                     window.location.href="menup.php";
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
  <h1>Datos del modelo</h1>
</div>
 <br />
   <div id="modelo"></div>

   <br />

  <button type="button" name="btnguardar" id="btnguardar" class="btn btn-primary btn-lg btn-block">Aceptar</button>
  <button type="button" name="btnsalir" id="btnsalir" class="btn btn-primary btn-lg btn-block">Salir</button>
</form>
</div>

</body>
</html>