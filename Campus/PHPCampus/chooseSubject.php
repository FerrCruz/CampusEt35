<?php

	include("connect.php");
	
    $subject = $_POST(''); // todo

    if ($query = $conexion->prepare("SELECT * FROM materia WHERE nombre = ?")) {

        $query->bind_param("s", $subject);
        $query->execute();
        $query->bind_result(); // todo
        $query->fetch();
        $query->close();

        // todo
    }
?>