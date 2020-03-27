<?php

	include("connect.php");

    $schedule = $_POST(''); // todo

    if ($query = $conexion->prepare("SELECT * FROM horario WHERE nombre = ?")) {

        $query->bind_param("s", $schedule);
        $query->execute();
        $query->bind_result(); // todo
        $query->fetch();
        $query->close();

        // todo
    }
?>