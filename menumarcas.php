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
              window.location="menuproductos.php";
          }
      );
         
         $("#agregar").click(
         function()
         {
            sessionStorage.setItem("vengDe","menumarcas");
            window.location="abmmarca.php";
         }
      );
      $("#consultar").click(
         function()
         {
            window.location="marcas.php";
         }
      );

      }
 );
</script>
</head>
<body>
<?php
include("navegacion.php");
?>
<br />
<br />
<br />

<div class="container">
  <div id="productos">
          <div class="row">
                   <div class="col-lg-3">
                          <button type="button" id="agregar" name="agregar" class="btn btn-light btn-lg active">
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
                           
                     </div>
                                            
                       <div class="col-lg-3">
                                         
                      </div>
          </div>
   </div>

</div>
</body>
</html>