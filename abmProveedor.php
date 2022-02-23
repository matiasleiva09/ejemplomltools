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
<script src="core/js/libiahtool/alert.js"></script>
<script src="core/js/libiahtool/input.js"></script>
<script src="core/js/libiahtool/comboBox.js"></script>
<script src="core/js/libiahtool/ajax.js"></script>
<link rel="stylesheet" href="core/js/bootstrap/css/bootstrap.css">
<?php
include("core/daobase/Sql.php");
include("core/babase/BusinessActionJSON.php");
include("ob/Persona.php");
include("ob/proveedor.php");
include("ba/EncontrarProveedorBA.php");
include("ba/abmProveedorBA.php");
if($proveedor==null)
    $proveedor=new Proveedor();
if($_GET["pId"]!="")
{
    //$proveedor= buscar($_POST["pId"]);
    $vBA = new EncontrarProveedorBA($_GET["pId"]);
    $vBA->realizar();
    $proveedor=$vBA->getProveedor();
    ?>
      <title>Editar Proveedor: <?=$_GET["pId"].": ".$proveedor->getNombre()?> </title>
   <?php
}
else
{
   
    ?>
        <title>Agregar Nuevo Proveedor</title>
    <?php
}
?>
<script language="javascript">
  $(document).ready(
   
     function()
     {
         var alerta = new Alert();
         alerta.id="alerta";
         var txtnombre = new Input();
        txtnombre.construirRapidoTexto("Nombre/Razón Social:","txtnombre","nombre",true,"text",false,false,false);

        var txtcuit = new Input();
        txtcuit.construirRapidoTexto("CUIT:","txtcuit","cuit",true,"text",false,false,false);
        
        var datosIVA = new Array();
        datosIVA[0]= new ItemComboBox();
        datosIVA[0].crearRapido("CONSUMIDOR FINAL","CONSUMIDOR FINAL","",true);
        datosIVA[1]= new ItemComboBox();
        datosIVA[1].crearRapido("MONOTRIBUTISTA","MONOTRIBUTISTA","",false);
        datosIVA[2]= new ItemComboBox();
        datosIVA[2].crearRapido("RESPONSABLE INCRIPTO","RESPONSABLE INSCRIPTO","",false);
        datosIVA[3]= new ItemComboBox();
        datosIVA[3].crearRapido("EXCENTO","EXCENTO","",false);

        var cmbcondicioniva = new ComboBox();
        cmbcondicioniva.construirRapido("Condición IVA:",false,"Seleccione condición IVA","condicioniva","cmbcondicioniva","SIMPLE",
        datosIVA,null,true);
        //-------------------------------------------------------------------------------------------------

        //CONTACTO

        var txttelefono = new Input();
        txttelefono.construirRapidoTexto("Teléfono:","txttelefono","telefono",false,"text",false,false,true);

        var txtemail = new Input();
        txtemail.construirRapidoTexto("Email:","txtemail","email",false,"text",true,false,false);

        var txtcelular = new Input();
        txtcelular.construirRapidoTexto("Celular:","txtcelular","celular",false,"text",false,false,true);

        //------------------------------------------------------------------------------------------
         
        //DOMICILIO
        var txtcalle = new Input();
        txtcalle.construirRapidoTexto("Calle:","txtcalle","calle",false,"text",false,false,false);

        var txtpiso = new Input();
        txtpiso.construirRapidoTexto("Piso:","txtpiso","piso",false,"text",false,false,false);

        var txtdpto = new Input();
        txtdpto.construirRapidoTexto("Depto:","txtdpto","dpto",false,"text",false,false,false);

        var txtnro = new Input();
        txtnro.construirRapidoTexto("Nro:","txtnro","nro",false,"text",false,false,false);

        var txtlocalidad = new Input();
        txtlocalidad.construirRapidoTexto("Localidad:","txtlocalidad","localidad",false,"text",false,false,false);

        var txtprovincia = new Input();
        txtprovincia.construirRapidoTexto("Provincia:","txtprovincia","provincia",false,"text",false,false,false);

        var txtcp = new Input();
        txtcp.construirRapidoTexto("CP:","txtcp","cp",false,"text",false,false,false);

        
        txtnombre.valor("<?=$proveedor->getNombre()?>");
        txtcuit.valor("<?=$proveedor->getCuit()?>");
        <?php
           if($proveedor->getId()!="")
           {
              ?>
                  cmbcondicioniva.valor("<?=$proveedor->getCondicionIVA()?>");
              <?php
           }
       
        ?>
        txttelefono.valor("<?=$proveedor->getTelefono()?>");
        txtcelular.valor("<?=$proveedor->getCelular()?>");
        txtemail.valor("<?=$proveedor->getEmail()?>");
        txtcalle.valor("<?=$proveedor->getCalle()?>");
        txtnro.valor("<?=$proveedor->getNro()?>");
        txtpiso.valor("<?=$proveedor->getPiso()?>");
        txtdpto.valor("<?=$proveedor->getDpto()?>");
        txtlocalidad.valor("<?=$proveedor->getLocalidad()?>");
        txtprovincia.valor("<?=$proveedor->getProvincia()?>");
        txtcp.valor("<?=$proveedor->getCp()?>");
        $("#btnguardar").click
        (
            function()
            {
                if(txtnombre.obtenerValor()!="" && cmbcondicioniva.obtenerValor()!="")
                {
                    var parametros="";
                    var id=<?=$proveedor->getId()?>;
                    parametros="id="+id;
                    if(id > 0)
                        parametros+="&modo=E";
                    else
                        parametros+="&modo=A";
                    parametros+="&nombre="+$.trim($("#txtnombre").val());
                    parametros+="&cuit="+$.trim($("#txtcuit").val());
                    parametros+="&condicioniva="+cmbcondicioniva.obtenerValor();
                    parametros+="&telefono="+$.trim($("#txttelefono").val());
                    parametros+="&celular="+$.trim($("#txtcelular").val());
                    parametros+="&email="+$.trim($("#txtemail").val());
                    parametros+="&calle="+$.trim($("#txtcalle").val());
                    parametros+="&nro="+$.trim($("#txtnro").val());
                    parametros+="&piso="+$.trim($("#txtpiso").val());
                    parametros+="&dpto="+$.trim($("#txtdpto").val());
                    parametros+="&localidad="+$.trim($("#txtlocalidad").val());
                    parametros+="&provincia="+$.trim($("#txtprovincia").val());
                    parametros+="&cp="+$.trim($("#txtcp").val());
                    //window.alert(parametros);
                    var ajax = new Ajax();
                    ajax.asincronico=false;
                    ajax.id="pResultado";
                    ajax.metodo="POST";
                    ajax.pagina="controladores/proveedores.php";
                    ajax.parametros=parametros;
                    ajax.tipoDeDatos="json";
                    var resultado = ajax.obtenerDatos();
                  //  window.alert(resultado["estado"]);
                     if(resultado["estado"]=="ok")
                     {
                        if(id<=0)
                        {
                            if(sessionStorage.getItem("vengoDe")=="proveedores")
                                window.location.href="menup.php";
                            else
                                window.location.href="proveedores.php";
                        }
                        else
                        {
                            window.location.href="proveedores.php";
                        }

                     }
                     else
                     {
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
                if(sessionStorage.getItem("vengoDe")=="proveedores")
                    window.location.href="menup.php";
                else
                    window.location.href="proveedores.php";
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
<form action="" method="post" name="formP" id="formP">
<div class="page-header">
  <h1>Datos Básicos</h1>
</div>
 <br />
   <div id="nombre"></div>
   <div id="cuit"></div>
   <div id="condicioniva"></div>

  <br />
  <br />
  <br />

  <div class="page-header">
     <h1>Datos de Contacto</h1>
  </div>
  <br />
   <div id="telefono"></div>
   <div id="celular"></div>
   <div id="email"></div>

  <br />
  <br />
  <br />

  <div class="page-header">
     <h1>Datos del Domicilio</h1>
  </div>
  <br />

  <div id="calle"></div>
  <div id="nro"></div>
  <div id="piso"></div>
  <div id="dpto"></div>
  <div id="localidad"></div>
  <div id="provincia"></div>
  <div id="cp"></div>

  <button type="button" name="btnguardar" id="btnguardar" class="btn btn-primary btn-lg btn-block">Aceptar</button>
  <button type="button" name="btnsalir" id="btnsalir" class="btn btn-primary btn-lg btn-block">Salir</button>
</form>
</div>

</body>
</html>