<?php
include("../core/daobase/Sql.php");
include("../core/babase/BusinessActionJSON.php");
include("../ob/Persona.php");
include("../ob/proveedor.php");
include("../ob/imagenProducto.php");
include("../ob/producto.php");
include("../ba/EncontrarProveedorBA.php");
include("../ba/productoBA.php");
$modo = $_POST["modo"];
if($modo=="listar")
{
    $vBA = new ProductoBA(null,$modo);
    $vBA->realizar();
    echo $vBA->getResultadoJSON();
}
else if($modo=="cargararchivo")
{
    if($_FILES["imagen"]!=null)
    {
        $prefijo=getNombreAleatorio(10);
        $nombreCompleto="../../imagenes/". $prefijo.$_FILES['imagen']['name'];
        copyFoto($_FILES['imagen']['tmp_name'],$nombreCompleto);
    }
    echo '{"fotosubida":"'. $prefijo.$_FILES['imagen']['name'].'","path":"../imagenes/"}';
}
else if($modo =="A" || $modo=="E" || $modo=="B" || $modo=="combobox")
{
    
    $imagenes=array();
    $i=0;
    $imagenp=procesoDeFoto($_POST["imagen"],true,0);
    $imagen1=procesoDeFoto($_POST["imagen1"],false,0);
    $imagen2=procesoDeFoto($_POST["imagen2"],false,1);
    $imagen3=procesoDeFoto($_POST["imagen3"],false,2);
    if($imagen1!="")
    {
        $imagenes[$i] = new ImagenProducto(0,0,$imagen1);
        $i++;
    }
    if($imagen2!="")
    {
        $imagenes[$i] = new ImagenProducto(0,1,$imagen2);
        $i++;
    }
    if($imagen3!="")
    {
        $imagenes[$i] = new ImagenProducto(0,2,$imagen3);
        $i++;
    }
         
    if($modo=="A" || $modo=="E")
    {
        $vBAProv= new EncontrarProveedorBA($_POST["idproveedor"]);
        $vBAProv->realizar();
        $proveedor=$vBAProv->getProveedor();
        $vBAProv=null;
    }
   
    $producto = new Producto($_POST["id"],$_POST["nombre"],$_POST["codigo"],$_POST["descripcion"],null,null,
    $proveedor,$_POST["marca"],$_POST["rubro"],$_POST["stock"],$_POST["stockminimo"],
    $_POST["costo"],$_POST["precioventa"],$imagenp,$imagenes);
    $vBA = new productoBA($producto,$modo);
    $vBA->realizar();
    echo $vBA->getResultadoJSON();
}
else
{
    echo '{"estado":"sin comando"}';
}

function procesoDeFoto($xArchivo,$principal,$orden)
{
    $resultado=null;
    if($xArchivo!="")
    {
        
        if($_POST["id"]!="0" && $_POST["id"]!="")
        {
            Sql::conectar();
            Sql::beginTransaction();
            if($principal)
            {
                $imagenactual =Sql::encontrar("select primagen from producto where pridproducto=".$_POST["id"]);
                Sql::commit();
                if($imagenactual!=null && $imagenactual["primagen"]!=$xArchivo)
                {
                    unlink("../../imagenes/".$imagenactual["primagen"]);
                }
            }
            else
            {
                $imagenactual =Sql::encontrar("select iparchivo,ipidimagen from imagen_producto where iporden=".$orden." and ipidproducto=".$_POST["id"]);
                if($imagenactual!=null && $imagenactual["iparchivo"]!=$xArchivo)
                {
                    unlink("../../imagenes/".$imagenactual["iparchivo"]);
                    Sql::ejecutar("update imagen_producto set iparchivo='".$xArchivo."' where ipidimagen=".$imagenactual["ipidimagen"]);
                    //Sql::ejecutar("delete from imagen_producto where  iporden=".$orden." and ipidproducto=".$_POST["id"]);
                }
               
                Sql::commit();
            }
           
        }
         
    }
    return $xArchivo;
}

function copyFoto($xArchivo,$xDestino)
{
    if (copy($xArchivo,$xDestino))
    {
      //  echo '{"estado":"soltero"}';
    }
    else
    {
        echo '{"estado":"Error al subir el archivo"}';
    }
}

function getNombreAleatorio($n) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
} 
?>