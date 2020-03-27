<?php
    
    include("connect.php");
    
    if ($query = $conexion->query("SELECT nombre FROM materias")) {

        $query->execute();
        $query->bind_result($schedule);

        echo "<select>";
        while ($query->fetch()) {
            echo "<option value='" . $schedule . "'>" . $schedule . "</option>";
        }   
        $query->close();
        echo "</select>";
    }
 
?>