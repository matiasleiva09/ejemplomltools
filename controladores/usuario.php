<?php
session_start();
include("../core/daobase/Sql.php");
$modo=$_POST["modo"];
if($modo=="listar")
{
    Sql::conectar();
    Sql::beginTransaction();
    $vSQL="select  usidusuario as id,usnombre as usuario,usactivo as activo,usfecha as fechaalta,usfechabaja as fechabaja";
    $vSQL.=",uscalle as calle,usnro as nro,uspiso as piso,usdpto as dpto,uslocalidad as localidad,";
    $vSQL.="usprovincia as provincia,uscp as cp,ustelefono as telefono,uscelular as celular,usemail as email"; 
    $vSQL.=" from usuario order by usidusuario asc;";
    $consulta=Sql::consultar($vSQL);
    Sql::commit();
    if($consulta!=null)
    {
        $json=array();
		$json["cantidad"]=count($consulta);
        $json["registros"]=$consulta;
        echo json_encode($json);
    }
    else
    {
        $json=array();
		$json["cantidad"]="0";
        $json["registros"]=array();
        echo json_encode($json);
    }
}
else if ($modo=="B")
{
    Sql::conectar();
    Sql::beginTransaction();
    $vSQL="update usuario set usactivo=false,usfechabaja=current_date where usidusuario=".$_POST["id"];
    Sql::commit();
    echo '{"estado":"ok"}';
}
else if($modo=="loguin")
{
    Sql::conectar();
    Sql::beginTransaction();
    $xContrasena=hash("sha256",sha1(md5(hash("sha256",$_POST["contrasena"]))));
    $vSQL="";
    $vSQL="select usidusuario,usnombrecompleto as nombre from usuario where usnombre='".$_POST["usuario"]."'";
    $vSQL.=" and uscontrasena='".$xContrasena."'";
    $resultado=Sql::encontrar($vSQL);
    Sql::commit();
  
    if($resultado!=null)
    {
        $_SESSION["cliId"]=$resultado["usidusuario"];
        $_SESSION["cliNombre"]=$resultado["nombre"];
        $_SESSION["cliUsuario"]=$_POST["usuario"];
        echo '{"estado":"ok"}';
    }
    else
        echo '{"estado":"no encontrado"}';

}
else if($modo=="registro")
{
    Sql::conectar();
    Sql::beginTransaction();
    $xContrasena=hash("sha256",sha1(md5(hash("sha256",$_POST["contrasena"]))));
    $vSQL="insert into usuario";
    $vSQL.=" (usnombre,uscontrasena,usfecha,usfechabaja,usactivo,usnombrecompleto,";
    $vSQL.="uscalle,usnro,uspiso,usdpto,uslocalidad,usprovincia,";
    $vSQL.="uscp,ustelefono,uscelular,usemail)";
    $vSQL.=" values ('".$_POST["usuario"]."','".$xContrasena."',";
    $vSQL.="current_date,null,true,'".$_POST["nombrecompleto"]."','','','','','','','','".$_POST["telefono"]."','".$_POST["celular"]."',";
    $vSQL.="'')";
    Sql::ejecutar($vSQL);
    Sql::commit();
    /*$titulo="Registro";
    $mensaje.="<b>Fecha:</b> ".date("Y-m-d H:i:s")."<br />";
    $mensaje.="<b>Nombre y Apellido:</b> ".$_POST['nya'].'<br />';
    $mensaje.="<b>Teléfono:</b> ".$_POST['telefono'].'<br />';
    $mensaje.="<b>Mensaje:</b><br />";
    $mensaje.=$_POST['consulta'];
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // More headers
    $headers .= 'From: <www-data@vps-1589062-x.dattaweb.com>' . "\r\n";
    $headers .= 'Cco: matiasleiva09@gmail.com' . "\r\n";
    if(mail("jmelectricsolution@gmail.com",$titulo,$mensaje,$headers))
    {
       echo '{"estado":"ok"}';
    }
    else
    {
	   echo '{"estado":"error"}';
    }  */
    echo '{"estado":"ok"}';

}
else if($modo=="activar_cuenta")
{
    Sql::conectar();
    Sql::beginTransaction();
    $vSQL="update usuario set usactivo=true where usidusuario=".$_POST["usuario"];
    Sql::ejecutar($vSQL);
    $vSQL="select usnombre,usnombrecompleto from usuario where usidusuario=".$_POST["usuario"];
    $_SESSION["cliId"]=$resultado["usuario"];
    $_SESSION["cliNombre"]=$resultado["usnombrecompleto"];
    $_SESSION["cliUsuario"]=$_POST["usnombre"];
    Sql::commit();
}
?>