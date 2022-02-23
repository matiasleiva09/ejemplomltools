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
<script src="core/js/libiahtool/Grilla.js"></script>
<script src="core/js/libiahtool/ajax.js"></script>
<script language="javascript">
  $(document).ready
(
   function()
   {
      var alerta= new Alert();
      alerta.id="alerta"; 
      $("#btnVolver").click
            (
                function()
                {
                   window.location="menuproveedor.php";
                }
            );
      var grProveedores = new Grilla();
       i=0;
       grProveedores.columnas = new Array();
       grProveedores.columnas[0] = new Columna();
       grProveedores.columnas[0].crearRapido("Id","left","id");
       i=i+1;
       grProveedores.columnas[i] = new Columna();
       grProveedores.columnas[i].crearRapido("Nombre","left","nombre");
       i=i+1;
       grProveedores.columnas[i] = new Columna();
       grProveedores.columnas[i].crearRapido("Cónd. IVA","left","condicioniva");
       i=i+1;
       grProveedores.columnas[i] = new Columna();
       grProveedores.columnas[i].crearRapido("Cuit","left","cuit");
       i=i+1;
       grProveedores.columnas[i] = new Columna();
       grProveedores.columnas[i].crearRapido("Tel","left","telefono");
       i=i+1;
       grProveedores.columnas[i] = new Columna();
       grProveedores.columnas[i].crearRapido("Celular","left","celular");
       i=i+1;
       grProveedores.columnas[i] = new Columna();
       grProveedores.columnas[i].crearRapido("Email","left","email");
       i=i+1;
       grProveedores.columnas[i] = new Columna();
       grProveedores.columnas[i].crearRapido("Dirección","left","direccion");

 
       grProveedores.id="grProveedores";
	   grProveedores.pagina="controladores/proveedores.php";
	   grProveedores.parametros="modo=listar";
       grProveedores.limitePorPagina=30;
       grProveedores.editarGrilla=
		  function(dato)
		  {
            location.href="abmProveedor.php?pId=" + dato["id"];
      };
      grProveedores.render();	
      grProveedores.borrar=
       function(datos)
       {
           var ajax = new Ajax();
           ajax.asincronico=false;
           ajax.id="pResultado";
           ajax.metodo="POST";
           ajax.pagina="controladores/proveedores.php";
           ajax.parametros="modo=B&id=" + datos["id"];
           ajax.tipoDeDatos="json";
           var resultado = ajax.obtenerDatos();
           
           if(resultado["estado"]=="ok")
           {
               alerta.show("OK","Exito!","Se ha borrado el proveedor correctamente!"); 
               grProveedores.recargar();
               return true;
           }
           else
           {
               alerta.show("ERROR","Error!","No se ha podido borrar el proveedor.");
               return false;
           } 
       }
     

   }
);
</script>
</head>
<body>
<?php
require("navegacion.php");
?>
<br>
<br>
<div id="alerta"></div>
<br>
<br>
<div id="pResultado"></div>
<div id="grProveedores"></div>

</body>
</html>