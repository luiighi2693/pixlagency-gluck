<?php 
include("conex.php");
$id=$_POST['id'];
if (isset($id)){
   $sql = mysql_query("DELETE from servicios WHERE codigo_servicio=$id")or die(mysql_error());
}else{
   echo "Debe especificar un 'codigo_servicio'.\n";
}
header('Location:../lista-servicios.php');
?>

