<?php
session_start();
include("../core/daobase/Sql.php");
$modo=$_POST["modo"];
if($modo=="loguin")
{
    $xContrasena=hash("sha256",sha1(md5(hash("sha256",$_POST["contrasena"]))));
    Sql::conectar();
	Sql::beginTransaction();
    //$vSQL="select admid as id,admdescripcion as descripcion from administador where admnombre=:nombre and admcontrasena=:contrasena";
    $vSQL="select admid as id,admdescripcion as descripcion";
    $vSQL.=" from administador";
    $vSQL.=" where admnombre='".$_POST["usuario"]."'";
    $vSQL.=" and admcontrasena='".$xContrasena."'";
    //$parametros= array(":nombre"=>$xUsuario,":contrasena"=>$xContrasena);
   // $resultado=Sql::encontrarParametros($vSQL,$parametros);
    $resultado=Sql::encontrar($vSQL);
    Sql::commit();
    if($resultado["id"]!="")
    {
        $_SESSION["AdmUser"]=$_POST["usuario"];
        $_SESSION["AdmDesc"]=$resultado["descripcion"];
        $_SESSION["AdmId"]=$resultado["id"];
        echo '{"estado":"ok"}';
    }
    else
        echo '{"estado":"error"}';
}  

?>