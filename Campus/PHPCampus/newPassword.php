<?php

    include("connect.php");

    $user = $_POST['user'];
    $code = $_POST['code'];
    $newPassword = $_POST['newPassword'];

    if ($query = $conexion->prepare("SELECT COUNT(*) as existe, codigo_recu, TIMESTAMPDIFF(minute, tiempo, now()) FROM usuarios WHERE nombre_us = ?")) {

        $query->bind_param("s", $user);
        $query->execute();
        $query->bind_result($existe, $respaldo, $tiempo);
        $query->fetch();
        $query->close();

        if ($existe) {
            if ($tiempo <= 15) {
                if ($respaldo === $code) {
                    if(comprobarContraseña($newPassword)) {
                        if($query = $conexion->prepare("UPDATE usuarios SET codigo_recu = null, tiempo = null, intentos = 0, contrasena = ? WHERE nombre_us = ?")) {
                            $hashNewPass = password_hash($newPassword, PASSWORD_DEFAULT);
                            $query->bind_param("ss", $hashNewPass, $user);
                            $query->execute();
                            $query->close();
                            echo "La contraseña se ha actualizado.";
                        }
                    } else {
                        echo "La contraseña debe tener un minimo de 8 caracteres, una mayusculas, y un numero";
                    }                  
                } else {
                    echo "El codigo es incorrecto.";
                }       
            } else {
                echo "Ha superado los 15 minutos";
            }          
        } else {           
            echo "Ese usuario no existe.";
        }  
    }

    function comprobarContraseña ($contraseña) {
        
        if(strlen($contraseña) < 8)
            return false;
        
        $mayuscula = false;
        $numero = false;      
        foreach(str_split($contraseña) as $letra) {
            if (ord($letra) >= 65 && ord($letra) <= 90) {
                $mayuscula = true;
            } else if (ord($letra) >= 48 && ord($letra) <= 57) {
                $numero = true;
            }
        }

        if(!$mayuscula || !$numero)
            return false;
        else
            return true;
    }
?>