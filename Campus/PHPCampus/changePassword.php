<?php

    include("connect.php");

    session_start();
    $newPassword = $_POST['pass'];
    $user = $_SESSION['user'];

    if($query = $conexion->prepare("UPDATE usuarios SET codigo_recu = null, tiempo = null, intentos = 0, contrasena = ? WHERE user = ?")) {
        //$hashNewPass = password_hash($newPassword, PASSWORD_DEFAULT); // Genera contraseña aleatoria alfanumerica con caracteres
        $query->bind_param("ss", $newPassword, $user);
        $query->execute();
        $query->close();
		header("Location: ../HTMLCampus/subpaginas/paginaRecuperacion/pagina4DeRecuperacion.html");
    }
?>