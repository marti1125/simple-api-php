<?php

//Concección a base de datos Mysql

$host = 'localhost';
$username= 'root';
$password = 'mysql';
$db_name = 'clinica_internacional'
;

$db=mysql_connect($host, $username, $password) or die('Could not connect');

mysql_select_db($db_name, $db) or die('');

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/consulta/:dni', function ($dni) {
    $sth = mysql_query("select * from historial where dni = '".$dni."'");
    
	$rows = array();
	while($r = mysql_fetch_assoc($sth)) {
	    $rows[] = $r;
	}
	header("Content-Type: application/json");
	echo json_encode($rows);
	exit;
});

$app->get('/', function () {
    echo "Rest de Clinica";
});

$app->run();