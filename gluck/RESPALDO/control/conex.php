<?php	
//conectar con el servidor y la base de datos
@$link=mysql_connect("localhost","root","")or die ("ERROR CONSULTA -> ".mysql_error());

mysql_select_db("bdblueweb")or die ("ERROR CONSULTA -> ".mysql_error());
?>