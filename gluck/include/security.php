<?php
@session_start();
$input_arr = array(); 
foreach ($_POST as $key => $input_arr) 
{ 
	$_POST[$key] = addslashes(clear($input_arr)); 
}
 
$input_arr = array(); 
foreach ($_GET as $key => $input_arr) 
{ 
	$_GET[$key] = addslashes(clear($input_arr)); 
}

array_walk($_POST, 'clear');
array_walk($_GET, 'clear');

function clear($valor)
{
	$valor = str_ireplace("SELECT","",$valor);
	$valor = str_ireplace("COPY","",$valor);
	$valor = str_ireplace("DELETE","",$valor);
	$valor = str_ireplace("DROP","",$valor);
	$valor = str_ireplace("DUMP","",$valor);
	$valor = str_ireplace(" OR ","",$valor);
	$valor = str_ireplace("%","",$valor);
	$valor = str_ireplace("LIKE","",$valor);
	$valor = str_ireplace("--","",$valor);
	$valor = str_ireplace("^","",$valor);
	$valor = str_ireplace("[","",$valor);
	$valor = str_ireplace("]","",$valor);
	$valor = str_ireplace("!","",$valor);
	$valor = str_ireplace("¡","",$valor);
	$valor = str_ireplace("?","",$valor);
	$valor = str_ireplace("=","",$valor);
	$valor = str_ireplace("&","",$valor);
	return $valor;
}