<?php
@session_start();

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'quiniela_user');
define('DB_PASSWORD', '52!dX7K[!9~Y');
define('DB_NAME', 'quinieladb_testing');
//define('DB_NAME', 'quinieladb');

$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_select_db($connect, "quinieladb_testing") or die("Could not connect to database!");

/* comprobar la conexión */
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}
