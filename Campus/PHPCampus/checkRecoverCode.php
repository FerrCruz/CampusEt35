<?php

    include("connect.php");

    session_start();
    $user = $_SESSION['user'];//Declaramos variables usuario y
    $code = $_POST['codigo'];// contraseña
    //Esta query se fija el tiempo del codigo de recuperacion

    if ($query = $conexion->prepare("SELECT COUNT(*) as existe, codigo_recu, TIMESTAMPDIFF(minute, tiempo, now()) FROM usuarios WHERE user = ?")) {
        $query->bind_param("s", $user); //Ejecuta la query
        $query->execute();
        $query->bind_result($existe, $respaldo, $tiempo);
        $query->fetch();
        $query->close();

        if ($existe) {
            if ($tiempo <= 15) {
                if ($respaldo === $code) {
                    echo 0;
					header("Location: ../HTMLCampus/subpaginas/paginaRecuperacion/pagina3DeRecuperacion.html");
                } else {
                    echo 1;
                }       
            } else {
                echo 2;
            }          
        } else {       
            echo 3;    
        }  
    }

/*
    0 - correcto
    1 - codigo incorrecto
    2 - supero el tiempo limite
    3 - usuario incorrecto
*/

?>