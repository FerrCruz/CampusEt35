<?php
    include("connect.php");
	
    $user = $_POST['documento'];
	
//Nos fijamos si el usuario existe
    if ($query = $conexion->prepare("SELECT COUNT(*) as existe, email FROM usuarios WHERE user = ?")) {

        $query->bind_param("d",$user); //ejecuatmos la query
        $query->execute();
        $query->bind_result($existe, $mail);
        $query->fetch();
        $query->close();

        if ($existe) {        //Si existe
            if($query = $conexion->prepare("UPDATE usuarios SET codigo_recu = ?, tiempo = now() WHERE user = ?")) {
                $query->bind_param("sd", $password, $user);
                $password = substr(hash('sha256', $user.Time()), 0, 10);
                $query->execute();
                $query->close();
                if(!mail($mail, "RESPALDO DE CONTRASEÑA", "Ingrese el codigo: ".$password)) {
                    echo "Ha habido un error.";
                }
                session_start();
                $_SESSION['user'] = $user;
				
				header("Location: ../HTMLCampus/subpaginas/paginaRecuperacion/pagina2DeRecuperacion.html");
                echo 0;        
            }
        } else {
            echo 1;
        }  
    }

//    0 - correcto
//   1 - usuario incorrecto
?>