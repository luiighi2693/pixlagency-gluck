<?php 
include("conex.php");
if(!empty($_POST['servicio'])){
$servicioa=$_POST["servicio"];
// la consulta UPDATE
$sqlUpdate = mysql_query("UPDATE servicios SET servicio='".$servicioa."'  WHERE  codigo_servicio = ".$_POST['id'])or die(mysql_error());
echo "Registro actualizado correctamente";
/*$QUERYU=mysql_query("UPDATE clientes SET nombre_cliente = '".$_POST["nombre_cliente"]."' WHERE id= ".$_POST["id"]);*/
}else{
 echo  '<script type="text/javascript">alert("Se actualizo correctamente.' . $to . '");</script>';
}

if(!empty($_POST['tipo_servicio'])){
$tipo_servicioa=$_POST["tipo_servicio"];
// la consulta UPDATE
$sqlUpdate = mysql_query("UPDATE servicios SET tipo_servicio='".$tipo_servicioa."'  WHERE codigo_servicio = ".$_POST['id'])or die(mysql_error());
echo "Registro actualizado correctamente";
/*$QUERYU=mysql_query("UPDATE clientes SET nombre_cliente = '".$_POST["nombre_cliente"]."' WHERE id= ".$_POST["id"]);*/
}else{
 echo  '<script type="text/javascript">alert("Se actualizo correctamente.' . $to . '");</script>';
}

if(!empty($_POST['costo_servicio'])){
$costo_servicioa=$_POST["costo_servicio"];
// la consulta UPDATE
$sqlUpdate = mysql_query("UPDATE servicios SET costo_servicio='".$costo_servicioa."'  WHERE codigo_servicio = ".$_POST['id'])or die(mysql_error());
echo "Registro actualizado correctamente";
/*$QUERYU=mysql_query("UPDATE clientes SET nombre_cliente = '".$_POST["nombre_cliente"]."' WHERE id= ".$_POST["id"]);*/
}else{
 echo  '<script type="text/javascript">alert("Se actualizo correctamente.' . $to . '");</script>';
}

if(!empty($_POST['descripcion_servicio'])){
$descripcion_servicioa=$_POST["descripcion_servicio"];
// la consulta UPDATE
$sqlUpdate = mysql_query("UPDATE servicios SET descripcion_servicio='".$descripcion_servicioa."'  WHERE codigo_servicio = ".$_POST['id'])or die(mysql_error());
echo "Registro actualizado correctamente";
/*$QUERYU=mysql_query("UPDATE clientes SET nombre_cliente = '".$_POST["nombre_cliente"]."' WHERE id= ".$_POST["id"]);*/
}else{
 echo  '<script type="text/javascript">alert("Se actualizo correctamente.' . $to . '");</script>';
}
header('Location:../lista-servicios.php');
?>