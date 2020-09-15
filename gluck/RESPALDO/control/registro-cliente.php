<?php 
include("conex.php");
$nombre_cliente=$_POST["nombre_cliente"];
$empresa_cliente=$_POST["empresa_cliente"];
$numero_cliente=$_POST["numero_cliente"];
$correo_cliente=$_POST["correo_cliente"];
$direccion_web=$_POST["direccion_web"];
$fecha_registro=date('Y/m/d');
$estatus_cliente=1;

//echo $nombre; para probrar
$QUERY=mysql_query("INSERT INTO clientes(nombre_cliente,empresa_cliente,numero_cliente,correo_cliente,direccion_web,fecha_registro,estatus_cliente) VALUES('".$nombre_cliente."','".$empresa_cliente."','".$numero_cliente."','".$correo_cliente."','".$direccion_web."','".$fecha_registro."','".$estatus_cliente."')") or die ("ERROR SQL: ".mysql_error());
header("location:../lista-clientes.php");
/*if($tipo=="3"){
	$nombre=$_POST["nombre"];
	$descripcion=$_POST["descrip"];
	$ingreso=$_POST["ingreso"];
	$emp=$_POST["empresa"];
	$registro=$_POST['registro'];
	if($registro=="1"){#inserta
		$QUERY=mysql_query("INSERT INTO grupos(nombre_grupo,descripcion_grupo,fecha_creacion_grupo,id_creador_empresa) VALUES('".$nombre."','".$descripcion."','".$ingreso."',(SELECT id_usuario FROM usuarios WHERE nombre='".$emp."'))") or die ("ERROR SQL: ".mysql_error());
		if($QUERY)
			echo 1;
		else
			echo 0;
	}
	if($registro=="0"){#actualiza
		$QUERY=mysql_query("UPDATE grupos
							SET nombre_grupo='".$nombre."',descripcion_grupo='".$descripcion."'
							WHERE id_grupo='".$id."'") or die ("ERROR SQL: ".mysql_error());
		if($QUERY)
			echo 1;
		else
			echo 0;
	}
}*/
?>

