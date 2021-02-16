<?php
require('../Connections/Connections.php');
require('../include/security.php');
require('../include/functions.php');


$rowid=$_REQUEST['rowid'];
$userId=$_REQUEST['userId'];
$username=$_REQUEST['username'];
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
	case '4':
		echo getByUsername($username, $connect);
		break;
	default:
		echo team($rowid, $connect);
		break;
}