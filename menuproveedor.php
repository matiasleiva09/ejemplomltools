<?php
include("sesion.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Menu</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
            $("#btnAgregarProveedor").click
            (
                function()
                {
                   window.location="abmProveedor.php";
                }
            );
            $("#btnConsultarProv").click
            (
                function()
                {
                   window.location="proveedores.php";
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
<form action="" method="post">
<div class="container">
     <div class="row" id="proveedores">
                                 <div class="col-lg-3" >
                                    <button type="button" name="btnAgregarProveedor" id="btnAgregarProveedor" class="btn btn-light btn-lg active">
                                      <img src="imagenes/mas.png" />
                                       <h5><b>AGREGAR</b></H5>
                                    </button>
                                </div>
                         <div class="col-lg-3">
        <button type="button" name="btnConsultarProv" id="btnConsultarProv" class="btn btn-light btn-lg active">
          <img src="imagenes/buscar.png" />
         <h5><b>CONSULTAR</b></H5>
        </button>
     </div>

     <div class="col-lg-3">
        <button type="submit" class="btn btn-light btn-lg active">
          <img src="imagenes/buscar.png" />
         <h5><b>AGREGAR FACTURAS</b></H5>
        </button>
     </div>

     <div class="col-lg-3">
      <button type="submit" class="btn btn-light btn-lg active">
          <img src="imagenes/buscar.png" />
         <h5><b>CONSULTAR FACTURAS</b></H5>
        </button>
     </div>
</div>
</body>
</html>