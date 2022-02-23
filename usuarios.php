<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inicio de Sesión</title>

<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="core/js/libiahtool/css/css.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="core/js/libiahtool/utils.js"></script>
<script src="core/js/libiahtool/alert.js"></script>
<script src="core/js/libiahtool/input.js"></script>
<script src="core/js/libiahtool/Grilla.js"></script>
<script src="core/js/libiahtool/ajax.js"></script>
<script language="javascript">
  $(document).ready
(
   function()
   {
      
      $("#btnVolver").click
      (
          function()
          {
              window.location="menup.php";
          }
      );
      var alerta= new Alert();
      alerta.id="alerta"; 
      var grusuario = new Grilla();
       i=0;
       grusuario.columnas = new Array();
       grusuario.columnas[0] = new Columna();
       grusuario.columnas[0].crearRapido("Id","left","id");
       i=i+1;
       grusuario.columnas[i] = new Columna();
       grusuario.columnas[i].crearRapido("Fecha alta","left","fechaalta");
       i=i+1;
       grusuario.columnas[i] = new Columna();
       grusuario.columnas[i].crearRapido("Fecha Baja","left","fechabaja");
       i=i+1;
       grusuario.columnas[i] = new Columna();
       grusuario.columnas[i].crearRapido("Usuario","left","usuario");
       i=i+1;
       grusuario.columnas[i] = new Columna();
       grusuario.columnas[i].crearRapido("Nombre Real","left","nombre");
       i=i+1;
       grusuario.columnas[i] = new Columna();
       grusuario.columnas[i].crearRapido("Telefono","left","telefono");
       i=i+1;
       grusuario.columnas[i] = new Columna();
       grusuario.columnas[i].crearRapido("Celular","left","celular");
       i=i+1;
       grusuario.columnas[i] = new Columna();
       grusuario.columnas[i].crearRapido("E-mail","left","email");
       i=i+1;


 
       grusuario.id="grusuario";
	   grusuario.pagina="controladores/usuario.php";
	   grusuario.parametros="modo=listar";
       grusuario.limitePorPagina=30;
       grusuario.editarGrilla=
	   function(dato)
	   {
           // sessionStorage.setItem("vengoDe","productos.php");
            //location.href="abmproducto.php?proId=" + dato["id"];

       };
       grusuario.render();	
       grusuario.agregarGrilla=
       (
           function(datos)
           {
               //sessionStorage.setItem("vengoDe","productos.php");
               //location.href="abmproducto.php";
           }
       );
       grusuario.borrar=
       function(datos)
       {
           var ajax = new Ajax();
           ajax.asincronico=false;
           ajax.id="pResultado";
           ajax.metodo="POST";
           ajax.pagina="controladores/usuario.php";
           ajax.parametros="modo=B&id=" + datos["id"];
           ajax.tipoDeDatos="json";
           var resultado = ajax.obtenerDatos();
           
           if(resultado["estado"]=="ok")
           {
               alerta.show("OK","Exito!","Se ha borrado el producto correctamente!"); 
               grusuario.recargar();
               return true;
           }
           else
           {
               alerta.show("ERROR","Error!","No se ha podido borrar el producto.");
               return false;
           } 
       }
     

   }
);
</script>
</head>
<body>
<br>
<br>
<?php
require_once("navegacion.php");
?>
<div id="alerta"></div>
<br>
<br>
<div id="pResultado"></div>
<div id="grusuario"></div>

</body>
</html>