<?php
	include("connect.php");//Conectamos con la base de datos
	
	$user     = $_POST['user'];//Declaramos variables usuario y
	$password = $_POST['pass'];// contraseña
	//Preparamos la query
	if ($query = $conexion->prepare("SELECT COUNT(*) as existe, contrasena, intentos = 5 FROM usuarios WHERE user = ?")) {

        $query->bind_param("s", $user); //El parametro del ? es $usuer
        $query->execute(); //Ejecutamos la query
        $query->bind_result($existe, $contraseña, $superoLimite);//Estos son los 3 resultados (se crean las variables cuando se hace el fetch)
        $query->fetch();//Se crean las variables
        $query->close(); //Se cierra el procedimiento la query
        if ($existe) { //Vemos si la contraseña existe
            if (!$superoLimite) { //Vemos si no supero el limite 
                // if (password_verify($password, $contraseña)) {
                    if ($password==$contraseña) {
                    session_start();
                    $_SESSION['usuario'] = $user;
                    $query = $conexion->prepare("UPDATE usuarios SET intentos = 0 WHERE user = ?");//Seteamos intentos a 0
                    $query->bind_param("s", $user);//Hsta el close se ejecuta la query
                    $query->execute();
                    $query->close();
					header("Location: ../HTMLCampus/subpaginas/inicioCampus/index.html");//Localizacion del index.html donde se encuentra el documento principal de la pagina
                    echo 0;
                } else {
                    echo "Usuario o contraseña incorrecta."; //Mandamos un mensaje de contraseña incorrecta
                    $query = $conexion->prepare("UPDATE usuarios SET intentos = intentos + 1 WHERE user = ?"); //Le sumamos +1 a los intentos de contraseña del usuario
                    $query->bind_param("s", $user); //Ejecutamos la query con el ? siendo $user
                    $query->execute();
                    $query->close(); //Aca termina la ejecucion de la query
    
                    $query = $conexion->prepare("SELECT intentos = 5 FROM usuarios WHERE user = ?");
                    $query->bind_param("s", $user);
                    $query->execute();
                    $query->bind_result($superoLimite);
                    $query->fetch();
                    $query->close();
                    echo 1;
    
                    if ($superoLimite) {
                        echo 2;
                    }   
                }        
            } else {
                echo 2;
            }              
        } else {
            echo 1;
        }
	}
	/*
    0 - correcto
    1 - contraseña incorrecta
    2 - supero el limite de intentos
*/
?>

