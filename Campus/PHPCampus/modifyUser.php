<?php

    include("connect.php");
    //Declaro las variables que el usuario puede actualizar
    $nombreUsuario = $_POST('nombreUsu');
    $apellidoUsuario = $_POST('apellidoUsu');
    $telUsuario = $_POST('telefonoUsuario');
    $emailUsuario = $_POST('emailUsuario');
    $contraseñaUsuario = $_POST('contraseñaUsuario');

    //Declaro las variables de actualizacion para el usuario
    $nombreUsuarioUpdate = $_POST('nombreUsuUpdate');
    $apellidoUsuarioUpdate = $_POST('apellidoUsuUpdate');
    $telUsuarioUpdate = $_POST('telefonoUsuarioUpdate');
    $emailUsuarioUpdate = $_POST('emailUsuarioUpdate');
    $contraseñaUsuarioUpdate = $_POST('contraseñaUsuarioUpdate');

    if($nombreUsuario != "" && $nombreUsuarioUpdate != "") {
        if($query = $conexion->prepare("SELECT dni from usuarios where nombre = ? and apellido = ?") {

			$query->bind_param("ss",$nombreUsuario,$apellidoUsuario); // Especificamos que tipo de dato es nuestra variable (declarada al principio) que utiliza la query.
			$query->execute(); // Ejecutamos la query.
			$query->bind_result($dniUsuario); // Se crea las variables para asignar el valor que nos devuelve la query.
			$query->fetch(); // Se guarda los valores que nos devuelve la query en las nueva variables creada anteriormente.
			$query->close(); // Cerramos la query.


            if($query = $conexion->prepare("UPDATE usuarios SET nombre = ? WHERE ")){


            } 

      

        }

    }


?>