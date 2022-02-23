<?php
session_start();
if(!isset($_SESSION["AdmUser"]))
{
    session_destroy();
    header("location:loguin.php");
}
?>