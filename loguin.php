<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Inicio de Sesión</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="core/js/libiahtool/alert.js"></script>
<script src="core/js/libiahtool/input.js"></script>
<script src="core/js/libiahtool/comboBox.js"></script>
<script src="core/js/libiahtool/ajax.js"></script>
<link rel="stylesheet" href="core/js/bootstrap/css/bootstrap.css">
<script language="javascript">
 $(document).ready
 (
     function()
     {
         var alerta = new Alert();
         alerta.id="alerta";
         var txtusuario = new Input();
         txtusuario.construirRapidoTexto("Usuario:","txtusuario","usuario",true,"text",false,false,false);

         var txtcontrasena = new Input();
         txtcontrasena.construirRapidoTexto("Contraseña:","txtcontrasena","contrasena",true,"password",false,false,false);

         $("#btnEntrar").click(
             function()
             {
                 if($.trim(txtusuario.obtenerValor())!="" && $.trim(txtcontrasena.obtenerValor())!="")
                 {
                       var ajax = new Ajax();
                       ajax.asincronico=false;
                       ajax.id="pResultado";
                       ajax.metodo="POST";
                       ajax.pagina="controladores/administradores.php";
                       ajax.parametros="modo=loguin";
                       ajax.parametros+="&usuario="+ txtusuario.obtenerValor();
                       ajax.parametros+="&contrasena="+ txtcontrasena.obtenerValor();
                       ajax.tipoDeDatos="json";
                       var resultado = ajax.obtenerDatos();
                       if(resultado["estado"]=="ok")
                       {
                            location.href="menup.php";
                       }
                       else
                      {
                           alerta.show("ERROR","Error!","Usuario y/o contraseña incorrectos.");
                      } 
                 }
                 else
                    alerta.show("ERROR","Atención!","Complete los campos marcados en rojo");
             }
         )
     }
 );
</script>
</head>
<body>
<div id="alerta"></div>
<div class="container">
<br />
<br />
<div id="usuario"></div>
<div id="contrasena"></div>
<button type="button" name="btnEntrar" id="btnEntrar" class="btn btn-primary btn-lg btn-block">Iniciar Sesión</button>
<div>
</body>
</html>

