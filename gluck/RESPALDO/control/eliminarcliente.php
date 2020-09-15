<?php 
include("conex.php");
$id=$_POST['id'];
if (isset($id)){
   $sql = mysql_query("DELETE from clientes WHERE id=$id")or die(mysql_error());
}else{
   echo "Debe especificar un 'id'.\n";
}
header('Location:../lista-clientes.php');
?>

