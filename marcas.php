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
              window.location="menuproductos.php";
          }
      );
      var alerta= new Alert();
      alerta.id="alerta"; 
      var grMarca = new Grilla();
       i=0;
       grMarca.columnas = new Array();
       grMarca.columnas[0] = new Columna();
       grMarca.columnas[0].crearRapido("Id","left","id");
       i=i+1;
       grMarca.columnas[i] = new Columna();
       grMarca.columnas[i].crearRapido("Descripción","left","marca");
       i=i+1;

 
       grMarca.id="grMarcas";
	   grMarca.pagina="controladores/marca.php";
	   grMarca.parametros="modo=listar";
       grMarca.limitePorPagina=30;
       grMarca.editarGrilla=
		  function(dato)
		  {
            sessionStorage.setItem("vengoDe","marcas.php"); 
           location.href="abmmarca.php?mId=" + dato["id"];
         };
      grMarca.agregarGrilla=
         function(dato)
         {
            sessionStorage.setItem("vengoDe","marcas.php"); 
            location.href="abmmarca.php";
            
         };
      grMarca.render();	
      grMarca.borrar=
       function(datos)
       {
           var ajax = new Ajax();
           ajax.asincronico=false;
           ajax.id="pResultado";
           ajax.metodo="POST";
           ajax.pagina="controladores/marca.php";
           ajax.parametros="modo=B&id=" + datos["id"];
           ajax.tipoDeDatos="json";
           var resultado = ajax.obtenerDatos();
           
           if(resultado["estado"]=="ok")
           {
               alerta.show("OK","Exito!","Se ha borrado la marca correctamente!"); 
               grMarca.recargar();
               return true;
           }
           else
           {
               alerta.show("ERROR","Error!","No se ha podido borrar la marca.");
               return false;
           } 
       }
     

   }
);
</script>
</head>
<body>
<?php
require_once("navegacion.php");
?>
<br>
<br>
<div id="alerta"></div>
<br>
<br>
<div id="pResultado"></div>
<div id="grMarcas"></div>

</body>
</html>