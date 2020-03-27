<?php
    
    include("connect.php");

    echo "string";

    if ($results = $conexion->query("SELECT nombre FROM materias")) {

        echo "<select>";
        while ($row = $results->fetch_assoc()) {        
            echo "<option value='" . $row["nombre"] . "'>" . $row["nombre"] . "</option>";
        }     
        echo "</select>";
    }
 
?>