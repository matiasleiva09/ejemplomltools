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
              window.location="menurubros.php";
          }
      );
      var alerta= new Alert();
      alerta.id="alerta"; 
      var grTipo = new Grilla();
       i=0;
       grTipo.columnas = new Array();
       grTipo.columnas[0] = new Columna();
       grTipo.columnas[0].crearRapido("Id","left","id");
       i=i+1;
       grTipo.columnas[i] = new Columna();
       grTipo.columnas[i].crearRapido("Rubro Principal","left","padre");
       i=i+1;
       grTipo.columnas[i] = new Columna();
       grTipo.columnas[i].crearRapido("Rubro","left","tipo");
       i=i+1;

 
       grTipo.id="grTipo";
	   grTipo.pagina="controladores/tipo.php";
	   grTipo.parametros="modo=listar";
       grTipo.limitePorPagina=30;
       grTipo.editarGrilla=
		  function(dato)
		  {
            sessionStorage.setItem("vengoDe","tipoproductos.php"); 
            location.href="abmtipo.php?tId=" + dato["id"];
      };
      grTipo.agregarGrilla=
         function(dato)
         {
            sessionStorage.setItem("vengoDe","tipoproductos.php"); 
            location.href="abmtipo.php";
            
         };
         grTipo.render();	
      grTipo.borrar=
       function(datos)
       {
           var ajax = new Ajax();
           ajax.asincronico=false;
           ajax.id="pResultado";
           ajax.metodo="POST";
           ajax.pagina="controladores/tipo.php";
           ajax.parametros="modo=B&id=" + datos["id"];
           ajax.tipoDeDatos="json";
           var resultado = ajax.obtenerDatos();
           
           if(resultado["estado"]=="ok")
           {
               alerta.show("OK","Exito!","Se ha borrado la marca correctamente!"); 
               grTipo.recargar();
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
<div id="grTipo"></div>

</body>
</html>