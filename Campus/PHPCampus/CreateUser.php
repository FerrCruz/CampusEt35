<?php

    include("connect.php");//Vinculas el archivo de conexión 'connect.php'
	
    $user = $_POST('user');//variable usuario
    $password = $_POST('password');//variable contraseña
    $name = $_POST('name');//variable nombre
    $lastName = $_POST('lastName');// variable apellido
    $dni = $_POST('dni');// variable DNI
    $phone = $_POST('phone');// variable telefono
    $mail = $_POST('mail');// variable correo electrónico
    $level = $_POST('level');//variable nivel
	
	if(($user!="")&&($password!="")&&($name!="")&&($lastname!="")&&($dni!="")&&($phone="")&&($mail!="")&&($level!=""))//Condiciono a que ningún campo este vacio al intentar registrarse
	{
		if($query->$conexion->prepare("select count(*) from usuarios where dni=?"))//preparo la consulta en sql 'contar las veces que esta el dni en la tabla usuarios'
		{
			$query->bind_param(d, $dni);//asigno el tipo de variable y la variable respectiva al '?' en la consulta.
			$query->execute();//ejecuta la consulta
			$query->bind_result($existe);//se crea la variable para asignar el valor de resultado de la consulta
			$query->fetch();//se asigna el valor a la variable
			$query->close();//se cierra la operacion de la consulta
		}
		if($existe==0)//Si la consulta anterior devuelve '0' significa que el usuario no estaba registrado todavía
		{
			if ($query = $conexion->prepare("insert into usuarios values(?,?,?,?,?,?,?,?)")) //preparo la consulta sql 'Inserto los datos en la tabla usuarios'
			{
				$query->bind_param(ssssddsd, $user, $password, $name, $lastName, $dni, $phone, $mail, $level);
				$query->execute();
				$query->close();
				echo "Usuario ingresado."
			}
		}else //en caso de que hay campos vacios
		{
			echo "Error. El usuario ya estaba registrado.";
		}
	}else //en caso de que ya este regostrado el usuario
	{
		echo "Error. Datos incompletos.";
	}

?>