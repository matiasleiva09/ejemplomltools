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
      var alerta= new Alert();
      alerta.id="alerta"; 
      var grModelo = new Grilla();
       i=0;
       grModelo.columnas = new Array();
       grModelo.columnas[0] = new Columna();
       grModelo.columnas[0].crearRapido("Id","left","id");
       i=i+1;
       grModelo.columnas[i] = new Columna();
       grModelo.columnas[i].crearRapido("Descripción","left","modelo");
       i=i+1;

 
       grModelo.id="grModelo";
	   grModelo.pagina="controladores/modelo.php";
	   grModelo.parametros="modo=listar";
       grModelo.limitePorPagina=30;
       grModelo.editarGrilla=
		  function(dato)
		  {
           location.href="abmmodelo.php?mId=" + dato["id"];
      };
      grModelo.agregarGrilla=
         function(dato)
         {
            sessionStorage.setItem("vengoDeModelo","modelo.php"); 
            location.href="abmmodelo.php";
            
         };
         grModelo.render();	
      grModelo.borrar=
       function(datos)
       {
           var ajax = new Ajax();
           ajax.asincronico=false;
           ajax.id="pResultado";
           ajax.metodo="POST";
           ajax.pagina="controladores/modelo.php";
           ajax.parametros="modo=B&id=" + datos["id"];
           ajax.tipoDeDatos="json";
           var resultado = ajax.obtenerDatos();
           
           if(resultado["estado"]=="ok")
           {
               alerta.show("OK","Exito!","Se ha borrado la marca correctamente!"); 
               grModelo.recargar();
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
<br>
<br>
<div id="alerta"></div>
<br>
<br>
<div id="pResultado"></div>
<div id="grModelo"></div>

</body>
</html>