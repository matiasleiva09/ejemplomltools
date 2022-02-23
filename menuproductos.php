<?php
include("sesion.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Menu</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
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
         
         $("#agregarProductos").click(
         function()
         {
            sessionStorage.setItem("vengDe","menuproductos");
            window.location="abmproducto.php";
         }
      );
      $("#consultar").click(
         function()
         {
            window.location="productos.php";
         }
      );

      $("#marcas").click(
         function()
         {
            window.location="menumarcas.php";
         }
      );

      $("#rubros").click(
         function()
         {
            window.location="menurubros.php";
         }
      );
      }
 );
</script>
</head>
<body>
<?php
require_once("navegacion.php");
?>
<br />
<br />
<br />

<div class="container">
  <div id="productos">
          <div class="row">
                   <div class="col-lg-3">
                          <button type="button" id="agregarProductos" name="agregarProductos" class="btn btn-light btn-lg active">
                                 <img src="imagenes/mas.png" />
                                 <h5><b>AGREGAR</b></H5>
                           </button>
                    </div>
                      <div class="col-lg-3">
                           <button type="button" name="consultar" id="consultar"  class="btn btn-light btn-lg active">
                              <img src="imagenes/buscar.png" />
                              <h5><b>CONSULTAR</b></H5>
                           </button>
                      </div>
                                            
                     <div class="col-lg-3">
                            <button type="button" name ="rubros" id="rubros" class="btn btn-light btn-lg active">
                             <img src="imagenes/rubro.png" />
                               <h5><b>RUBROS</b></H5>
                            </button>
                     </div>
                                            
                       <div class="col-lg-3">
                          <button type="button" name ="marcas" id="marcas" class="btn btn-light btn-lg active">
                             <img src="imagenes/bolsa-ecologica.png" />
                               <h5><b>MARCAS</b></H5>
                            </button>                  
                      </div>
          </div>
   </div>

</div>
</body>
</html>