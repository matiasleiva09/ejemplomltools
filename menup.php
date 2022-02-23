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
      $("#btnProvP").click(
         function()
         {
            window.location="menuproveedor.php";
         }
      );
      $("#btnProdP").click(
         function()
         {
            window.location="menuproductos.php";
         }
      );

      $("#btnVentasP").click(
         function()
         {
            window.location="menuventas.php";
         }
      );

      
      $("#btnEnviosP").click(
         function()
         {
            window.location="menuenvios.php";
         }
      );
     }
 );
</script>
</head>
<body>
<br />
<br />
<br />
<div class="container">

<div class="row" id="principal">
                                <div class="col-lg-3" >
                                 <button type="button" name="btnProvP" id="btnProvP"  class="btn btn-light btn-lg active">
                                 <img src="imagenes/empresario.png" />
                                 <h5><b>PROVEEDORES</b></H5>
                                </button>
                            </div>
                            <div class="col-lg-3">
                               <button type="button" name="btnProdP" id="btnProdP" class="btn btn-light btn-lg active">
                                  <img src="imagenes/producto.png" />
                                   <h5><b>PRODUCTOS</b></H5>
                                </button>
                            </div>

                            <div class="col-lg-3">
                              <button type="button" name="btnVentasP" id="btnVentasP" class="btn btn-light btn-lg active">
                              <img src="imagenes/carrito-de-compras.png" />
                             <h5><b>VENTAS</b></H5></button>
                            </div>

                           <div class="col-lg-3">
                              <button type="button" name="btnEnviosP" id="btnEnviosP" class="btn btn-light btn-lg active">
                              <img src="imagenes/entrega.png" />
                              <h5><b>ENVIOS</b></H5></button>
                           </div>
 </div>






</div>
</body>
</html>