<?php
include("sesion.php");
include("utilidades/Utils.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="core/js/bootstrap/js/typeahead.bundle.js"></script>
<script src="core/js/datepicker/js/bootstrap-datepicker.js"></script>
<script src="core/js/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
<script src="core/js/libiahtool/alert.js"></script>
<script src="core/js/libiahtool/input.js"></script>
<script src="core/js/libiahtool/comboBox.js"></script>
<script src="core/js/libiahtool/comboBoxPopup.js"></script>
<script src="core/js/libiahtool/ajax.js"></script>
<script src="core/js/libiahtool/uploadfile.js"></script>
<link rel="stylesheet" href="core/js/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="core/js/libiahtool/css/css.css">
<link rel="stylesheet" href="core/js/bootstrap/css/typeahead.css">
<link rel="stylesheet" href="core/js/datepicker/css/bootstrap-datepicker.css">
<?php
include("core/daobase/Sql.php");
include("core/babase/BusinessActionJSON.php");
include("ob/tipo.php");
include("ob/Persona.php");
include("ob/proveedor.php");
include("ob/producto.php");
include("ob/imagenProducto.php");
include("ba/productoBA.php");
include("ba/EncontrarProductoBA.php");
$producto=new Producto(0,"","","",null,null,null,"","",1,1,0,0,"",array());
if($_GET["proId"]!="")
{
    $vBA = new EncontrarProductoBA($_GET["proId"]);
    $vBA->realizar();
    $producto=$vBA->getProducto();
    ?>
      <title>Editar Tipo de Producto: <?=$producto->getId().": ".$producto->getCodigo()?> </title>
   <?php
}
else
{

    ?>
        <title>Agregar Nuevo Tipo de Producto</title>
  <?php
}
?>
<script language="javascript">
  $(document).ready(
   
     function()
     {
         var alerta = new Alert();
         alerta.id="alerta";

       

        var cargarimagenp = new UploadFile();
        cargarimagenp.construirRapido("Imagen principal","imagenp","txtimagenp","",true,"controladores/producto.php");
        <?php
             if($producto->getImagen()!="")
             {
                ?>
                  cargarimagenp.valorImagen("../imagenes/<?=$producto->getImagen()?>");
                <?php
             }
             else
             {
                ?>
                cargarimagenp.valorImagen("");
                <?php
             }
        ?>
       

 
        var cargarimagen1 = new UploadFile();
        cargarimagen1.construirRapido("Imagen 1","imagen1","txtimagen1","",true,"controladores/producto.php");
        <?php
            $imagen1="";
            $imagen2="";
            $imagen3="";
            for($i=0;$i<count($producto->getImagenes());$i++)
            {
                if($producto->getImagenes()[$i]->getPrioridad() == 0)
                   $imagen1=$producto->getImagenes()[$i]->getArchivo();
                else if($producto->getImagenes()[$i]->getPrioridad() == 1)
                   $imagen2=$producto->getImagenes()[$i]->getArchivo();
                else if($producto->getImagenes()[$i]->getPrioridad() == 2)
                   $imagen3=$producto->getImagenes()[$i]->getArchivo();
            }
        ?>
       

        <?php
             if($imagen1!="")
             {
                ?>
                 cargarimagen1.valorImagen("../imagenes/<?=$imagen1?>");
                <?php
             }
             else
             {
                ?>
                cargarimagen1.valorImagen("");
                <?php
             }
        ?>

        var cargarimagen2 = new UploadFile();
        cargarimagen2.construirRapido("Imagen 2","imagen2","txtimagen2","",true,"controladores/producto.php");
     

        <?php
             if($imagen2!="")
             {
                ?>
                   cargarimagen2.valorImagen("../imagenes/<?=$imagen2?>");
                <?php
             }
             else
             {
                ?>
                cargarimagen2.valorImagen("");
                <?php
             }
        ?>

        var cargarimagen3 = new UploadFile();
        cargarimagen3.construirRapido("Imagen 3","imagen3","txtimagen3","",true,"controladores/producto.php");
      
        <?php
             if($imagen3!="")
             {
                ?>
               cargarimagen3.valorImagen("../imagenes/<?=$imagen3?>");
                <?php
             }
             else
             {
                ?>
                cargarimagen3.valorImagen("");
                <?php
             }
        ?>
 
         var txtcodigo = new Input();
         txtcodigo.construirRapidoTexto("Código:","txtcodigo","codigo",true,"text",false,false,false);
         txtcodigo.valor("<?=$producto->getCodigo()?>");
         
         var txtnombre = new Input();
         txtnombre.construirRapidoTexto("Nombre:","txtnombre","nombre",true,"text",false,false,false);
         txtnombre.valor("<?=$producto->getNombre()?>");

         var txtstock = new Input();
         txtstock.construirRapidoTexto("Stock:","txtstock","stock",true,"text",false,false,false);
         txtstock.valor("<?=$producto->getStock()?>");

         var txtstockminimo = new Input();
         txtstockminimo.construirRapidoTexto("Stock Mínimo:","txtstockminimo","stockminimo",true,"text",false,false,false);
         txtstockminimo.valor("<?=$producto->getStockMinimo()?>");

         var txtcosto = new Input();
         txtcosto.construirRapidoTexto("Monto de compra:","txtcosto","costo",true,"text",false,false,false);
         txtcosto.valor("<?=$producto->getCostoTotal()?>");

         var txtprecioventa = new Input();
         txtprecioventa.construirRapidoTexto("Precio De Venta:","txtprecioventa","precioventa",true,"text",false,false,false);
         txtprecioventa.valor("<?=$producto->getPrecioVenta()?>");

         var txtdetalle = new Input();
         txtdetalle.construirRapidoTexto("Detalle:","txtdetalle","detalle",true,"textarea",false,false,false);
         txtdetalle.valor(`<?=$producto->getDescripcion()?>`);
         
         var cmbProveedor = new ComboBoxPopup();
         cmbProveedor.construirRapido("Proveedor","proveedor","cmbproveedor","modo=combobox","controladores/proveedores.php",true,false);
         cmbProveedor.valor("<?=$producto->getProveedor()?>");

         var txttipo = new ComboBoxPopup();
         txttipo.construirRapido("Rubro:","tipo","cmbtipo","modo=combobox","controladores/tipo.php",true,true);
         txttipo.valor("<?=$producto->getRubro()?>");

        
         var cmbMarcas = new ComboBoxPopup();
         cmbMarcas.construirRapido("Marca","marca","cmbmarca","modo=combobox","controladores/marca.php",true,true);
         cmbMarcas.valor("<?=$producto->getMarca()?>");
	  
        $("#btnguardar").click
        (
            function()
            {
                if(txtcodigo.obtenerValor()!="" && txtnombre.obtenerValor()!="")
                {
                   
                    var parametros="";
                    var id=<?=$producto->getId()?>;
                    var parametros = new FormData();
                    parametros.append("id",id);
                    if(id > 0)
                         parametros.append("modo","E");
                    else
                         parametros.append("modo","A");
                    parametros.append("nombre",txtnombre.obtenerValor());
                    parametros.append("descripcion",txtdetalle.obtenerValor());
                    parametros.append("codigo", txtcodigo.obtenerValor());
                    parametros.append("imagen",cargarimagenp.obtenerValor());
                    parametros.append("imagen1",cargarimagen1.obtenerValor());
                    parametros.append("imagen2", cargarimagen2.obtenerValor());
                    parametros.append("imagen3",cargarimagen3.obtenerValor());
                    parametros.append("stock",txtstock.obtenerValor());
                    parametros.append("stockminimo",txtstockminimo.obtenerValor());
                    parametros.append("costo",txtcosto.obtenerValor());
                    parametros.append("precioventa",txtprecioventa.obtenerValor());
                    parametros.append("idproveedor",cmbProveedor.obtenerId());
                    parametros.append("rubro",txttipo.obtenerValor());
                    parametros.append("marca" ,cmbMarcas.obtenerValor());
                    var ajax = new Ajax();
                    ajax.asincronico=false;
                    ajax.id="pResultado";
                    ajax.metodo="POST";
                    ajax.pagina="controladores/producto.php";
                    ajax.parametrosForm=parametros;
                    ajax.tipoDeDatos="json";
                    var resultado = ajax.obtenerDatosUpload();
                     if(resultado["estado"]=="ok")
                     {
                        if(id<=0)
                        {
                            if(sessionStorage.getItem("vengoDe")=="productos.php")
                            {
                                sessionStorage.removeItem("vengoDe");
                                window.location.href="productos.php";
                            }
                            else
                            {
                                sessionStorage.setItem("vengoDe","");
                                window.location.href="menuproductos.php";
                            }
                           
                        }
                        else
                        {
                            window.location.href="productos.php";
                        }

                     }
                     else
                     {
                        window.alert(JSON.stringify(resultado));
                        alerta.show("ERROR","Error!","Ha ocurrido un error inesperado");
                    } 
                }
                else
                {
                     alerta.show("ERROR","Atención!","Complete los campos marcados en rojo");
                }
        }
        );

        $("#btnsalir").click
        (
             function()
             {
                if(sessionStorage.getItem("vengoDe")=="productos.php")
                {
                    sessionStorage.removeItem("vengoDe");
                    window.location.href="productos.php";
                }
                else
                {
                     window.location.href="menuproductos.php";
                }
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
<?php
  
?>
<div id="alerta"></div>
<div class="page-header">
  <h1>Datos del tipo de producto</h1>
</div>
 <br />
   <div class="row">
      <div class="col-lg-3">
         <div id="imagenp"></div>
      </div>
      <div class="col-lg-3">
         <div id="imagen1"></div>
      </div>
      <div class="col-lg-3">
         <div id="imagen2"></div>
      </div>
      <div class="col-lg-3">
          <div id="imagen3"></div>
      </div>
   </div>
   <div id="imagenp"></div>
   <div id="codigo"></div>
   <div id="tipo"></div>
   <div id="marca"></div>
   <div id="proveedor"></div>
   <div id="nombre"></div>
   <div id="detalle"></div>
   <div id="stock"></div>
   <div id="stockminimo"></div>
   <div id="costo"></div>
   <div id="precioventa"></div>
   <br />

  <button type="button" name="btnguardar" id="btnguardar" class="btn btn-primary btn-lg btn-block">Aceptar</button>
  <button type="button" name="btnsalir" id="btnsalir" class="btn btn-primary btn-lg btn-block">Salir</button>
</form>
</div>

</body>
</html>