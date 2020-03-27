<?php
	include("connect.php");
	
	$nombreMateria = $_POST('subject');
	
	if($nombreMateria!="")//Condiciono a que ningún campo este vacio al intentar registrar
		{
			if($query = $conexion->prepare("select count(*) from materias where nombre_mat=?"))
			{
				$query->bind_param("s",$nombreMateria);
				$query->execute();
				$query->bind_result($existe);
				$query->fetch();
				$query->close();
			}
			if($existe==0)//Si la consulta anterior devuelve '0' significa que la materia no estaba registrada todavía
				{
					if ($query = $conexion->prepare("insert into materias values('',?)"))//preparo la consulta sql 'Inserto los datos en la tabla usuarios'
					{
						$query->bind_param("s", $nombreMateria);
						$query->execute();
						$query->close();
						echo "Materia ingresado.";
					}
		        }
				else//en caso de que hay campos vacios
				{
					echo "Error. La materia ya estaba registrada.";
				}
		}						
		else//en caso de que ya este registrada la materia
		{
			echo "Error. Datos incompletos.";
		}
?>