<?php 
include("conex.php");
/*$impuesto_servicio = $_POST['taskOption'];*/
/*$cero='0';*/
$costo_servicio = $_POST['costo_servicio'];
$servicio = $_POST['servicio'];
/*$total_servicio = $costo_servicio + ($costo_servicio * ($cero.".".$impuesto_servicio));*/
$tipo_servicio = $_POST['tipo_servicio'];
$descripcion_servicio = $_POST['descripcion_servicio'];
$QUERY=mysql_query("INSERT INTO servicios(servicio,tipo_servicio,costo_servicio,descripcion_servicio) VALUES('".$servicio."','".$tipo_servicio."','".$costo_servicio."','".$descripcion_servicio."')") or die ("ERROR SQL: ".mysql_error());
header("location:../lista-servicios.php");
?>