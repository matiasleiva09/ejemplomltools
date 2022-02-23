<?php
if(!isset($_SESSION["usUsuario"]))
    header("location:loguin.php");
else
    header("location:principal.php");
?>