<?php 
include("conex.php");
if(!empty($_POST['nombre_cliente'])){
$nombre_clientea=$_POST["nombre_cliente"];
// la consulta UPDATE
$sqlUpdate = mysql_query("UPDATE clientes SET nombre_cliente='".$nombre_clientea."'  WHERE id = ".$_POST['id'])or die(mysql_error());
echo "Registro actualizado correctamente";
/*$QUERYU=mysql_query("UPDATE clientes SET nombre_cliente = '".$_POST["nombre_cliente"]."' WHERE id= ".$_POST["id"]);*/
}else{
 echo  '<script type="text/javascript">alert("Se actualizo correctamente.' . $to . '");</script>';
}

if(!empty($_POST['empresa_cliente'])){
$empresa_clientea=$_POST["empresa_cliente"];
// la consulta UPDATE
$sqlUpdate = mysql_query("UPDATE clientes SET empresa_cliente='".$empresa_clientea."'  WHERE id = ".$_POST['id'])or die(mysql_error());
echo "Registro actualizado correctamente";
/*$QUERYU=mysql_query("UPDATE clientes SET nombre_cliente = '".$_POST["nombre_cliente"]."' WHERE id= ".$_POST["id"]);*/
}else{
 echo  '<script type="text/javascript">alert("Se actualizo correctamente.' . $to . '");</script>';
}

if(!empty($_POST['numero_cliente'])){
$numero_clientea=$_POST["numero_cliente"];
// la consulta UPDATE
$sqlUpdate = mysql_query("UPDATE clientes SET numero_cliente='".$numero_clientea."'  WHERE id = ".$_POST['id'])or die(mysql_error());
echo "Registro actualizado correctamente";
/*$QUERYU=mysql_query("UPDATE clientes SET nombre_cliente = '".$_POST["nombre_cliente"]."' WHERE id= ".$_POST["id"]);*/
}else{
 echo  '<script type="text/javascript">alert("Se actualizo correctamente.' . $to . '");</script>';
}

if(!empty($_POST['correo_cliente'])){
$correo_clientea=$_POST["correo_cliente"];
// la consulta UPDATE
$sqlUpdate = mysql_query("UPDATE clientes SET correo_cliente='".$correo_clientea."'  WHERE id = ".$_POST['id'])or die(mysql_error());
echo "Registro actualizado correctamente";
/*$QUERYU=mysql_query("UPDATE clientes SET nombre_cliente = '".$_POST["nombre_cliente"]."' WHERE id= ".$_POST["id"]);*/
}else{
 echo  '<script type="text/javascript">alert("Se actualizo correctamente.' . $to . '");</script>';
}

if(!empty($_POST['direccion_web'])){
$direccion_weba=$_POST["direccion_web"];
// la consulta UPDATE
$sqlUpdate = mysql_query("UPDATE clientes SET direccion_web='".$direccion_weba."'  WHERE id = ".$_POST['id'])or die(mysql_error());
echo "Registro actualizado correctamente";
/*$QUERYU=mysql_query("UPDATE clientes SET nombre_cliente = '".$_POST["nombre_cliente"]."' WHERE id= ".$_POST["id"]);*/
}else{
 echo  '<script type="text/javascript">alert("Se actualizo correctamente.' . $to . '");</script>';
}

header('Location:../lista-clientes.php');
?>

