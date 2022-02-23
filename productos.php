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
      var grProductos = new Grilla();
       i=0;
       grProductos.columnas = new Array();
       grProductos.columnas[0] = new Columna();
       grProductos.columnas[0].crearRapido("Id","left","id");
       i=i+1;
       grProductos.columnas[i] = new Columna();
       grProductos.columnas[i].crearRapido("Cód.","left","codigo");
       i=i+1;
       grProductos.columnas[i] = new Columna();
       grProductos.columnas[i].crearRapido("Nombre","left","nombre");
       i=i+1;
       grProductos.columnas[i] = new Columna();
       grProductos.columnas[i].crearRapido("Detalle","left","descripcion");
       i=i+1;
       grProductos.columnas[i] = new Columna();
       grProductos.columnas[i].crearRapido("Proveedor","left","proveedor");
       i=i+1;
       grProductos.columnas[i] = new Columna();
       grProductos.columnas[i].crearRapido("Rubro","left","rubro");
       i=i+1;
       grProductos.columnas[i] = new Columna();
       grProductos.columnas[i].crearRapido("Marca","left","marca");
       i=i+1;
       grProductos.columnas[i] = new Columna();
       grProductos.columnas[i].crearRapido("Stock","left","stock");
       i=i+1;
       grProductos.columnas[i] = new Columna();
       grProductos.columnas[i].crearRapido("Precio de Venta","left","precioventa");

 
       grProductos.id="grProductos";
	   grProductos.pagina="controladores/producto.php";
	   grProductos.parametros="modo=listar";
       grProductos.limitePorPagina=30;
       grProductos.editarGrilla=
	   function(dato)
	   {
            sessionStorage.setItem("vengoDe","productos.php");
            location.href="abmproducto.php?proId=" + dato["id"];

       };
       grProductos.render();	
       grProductos.agregarGrilla=
       (
           function(datos)
           {
               sessionStorage.setItem("vengoDe","productos.php");
               location.href="abmproducto.php";
           }
       );
       grProductos.borrar=
       function(datos)
       {
           var ajax = new Ajax();
           ajax.asincronico=false;
           ajax.id="pResultado";
           ajax.metodo="POST";
           ajax.pagina="controladores/producto.php";
           ajax.parametros="modo=B&id=" + datos["id"];
           ajax.tipoDeDatos="json";
           var resultado = ajax.obtenerDatos();
           
           if(resultado["estado"]=="ok")
           {
               alerta.show("OK","Exito!","Se ha borrado el producto correctamente!"); 
               grProductos.recargar();
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
<div id="grProductos"></div>

</body>
</html>