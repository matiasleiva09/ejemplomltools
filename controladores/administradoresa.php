<?php
include("core/daobase/Sql.php");

function loguin ($xUsuario,$xContrasena)
{
    $xContrasena=hash("sha256",sha1(md5(hash("sha256",$xContrasena))));
    Sql::conectar();
	Sql::beginTransaction();
    //$vSQL="select admid as id,admdescripcion as descripcion from administador where admnombre=:nombre and admcontrasena=:contrasena";
    $vSQL="select admid as id,admdescripcion as descripcion";
    $vSQL.=" from administador";
    $vSQL.=" where admnombre='".$xUsuario."'";
    $vSQL.=" and admcontrasena='".$xContrasena."'";
    //$parametros= array(":nombre"=>$xUsuario,":contrasena"=>$xContrasena);
   // $resultado=Sql::encontrarParametros($vSQL,$parametros);
    $resultado=Sql::encontrar($vSQL);
    Sql::commit();
    echo $resultado["id"];
    if($resultado["id"]!="")
    {
        $_SESSION["AdmUser"]=$xUsuario;
        $_SESSION["AdmDesc"]=$resultado["descripcion"];
        $_SESSION["AdmId"]=$resultado["id"];
        return true;
    }
    else
       return false;
}

   

?>