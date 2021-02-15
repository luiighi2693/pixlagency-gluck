<?php
require('../Connections/Connections.php');
require('../include/security.php');
require('../include/functions.php');


$rowid=$_REQUEST['rowid'];
$userId=$_REQUEST['userId'];
$fk_team=$_REQUEST['fk_team'];
$type=$_REQUEST['type'];
switch ($type) {
	case '1':
		echo team($rowid, $connect, $fk_team);
		break;
	case '2':
		echo team($rowid, $connect, $fk_team);
		break;
	case '3':
		echo inserUserPool($rowid, $userId, $connect);
		break;
	default:
		echo team($rowid, $connect);
		break;
}