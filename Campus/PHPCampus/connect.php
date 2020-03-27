<?php
	$server = "localhost";
	$user = "root";
	$password = "";
	$db = "CampusEt35";
	
	$conexion = new mysqli($server, $user, $password, $db);
	
	$conexion->set_charset("utf8");

?>