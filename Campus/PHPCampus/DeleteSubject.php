<?php

    include("connect.php"); // Vinculamos con el archivo de conexion("connect.php").
	
	$nameMateria = $_POST('materia'); // Asignamos valor a la variable $nameMateria.

	if($nameMateria!=""){ // Verificamos si algunas de estas 2 variables esta con datos vacíos;
		if($query = $conexion->prepare("SELECT count(*) as existe,id_materia from materias where nombre_mat=?")){ // Preparamos la query.
		 
			$query->bind_param(s,$nameMateria); // Especificamos que tipo de dato es nuestra variable (declarada al principio) que utiliza la query.
			$query->execute(); // Ejecutamos la query.
			$query->bind_result($existe,$idMateria); // Se crea las variables para asignar el valor que nos devuelve la query.
			$query->fetch(); // Se guarda los valores que nos devuelve la query en las nueva variables creada anteriormente.
			$query->close(); // Cerramos la query.
			
			if ($existe>0) { // Verificamos si existe la materia ingresada desde el formulario.
				if($query = $conexion->prepare("delete from materias where id_materia=?")){ // Preparamos la query para su modificacion.
					$query->bind_param(d,$idMateria); // Especificamos que tipo de dato son nuestra variables que utiliza la query UPDATE.
					$query->execute();
					$query->close();
					echo "¡Materia eliminada!";
				}
			}else{
				echo "La materia ingresada no existe."; // En caso de que la materia no exista se mostrará este mensaje.
			}
		}
	}else{
		echo "Error. Complete nombre de la materia."; // En caso de que los datos estan vacios se mostrará este mensaje.
	}
	
?>