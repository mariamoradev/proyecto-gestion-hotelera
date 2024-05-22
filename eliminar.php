<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $host = 'localhost';
    $dbname = 'GESTIONHOTELMJ';
    $user = 'postgres';
    $password = 'junior';


    $conexion = pg_connect("host=$host dbname=$dbname user=$user password=$password");

    if (!$conexion) {
        die('No se pudo conectar: ' . pg_last_error());
    }

    if (isset($_POST['ID_empleado']) && !isset($_POST['confirm_delete'])) {
       
        $ID_empleado = $_POST['ID_empleado'];

        if (!is_numeric($ID_empleado)) {
            die("El ID_empleado proporcionado no es válido.");
        }

        $query = "SELECT * FROM Personal_Hotel WHERE ID_empleado = $1";
        $result = pg_query_params($conexion, $query, array($ID_empleado));

        if (!$result) {
            die("Error en la consulta SQL: " . pg_last_error());
        }

        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_assoc($result);
            echo '<form action="" method="post" style="text-align: center; padding: 20px; background-color: #f9f9f9;">';
            echo '<input type="hidden" name="ID_empleado" value="' . htmlspecialchars($row['id_empleado']) . '">';
            echo '<h1 style="font-size: 2em; color: #ff0000;"><i class="fas fa-exclamation-triangle"></i> ¿Está seguro de eliminar al empleado ' . htmlspecialchars($row['nombres']) . ' ' . htmlspecialchars($row['apellidos']) . '?</h1><br>';
            echo '<input type="hidden" name="confirm_delete" value="true">';
            echo '<button type="submit" style="padding: 10px 20px; background-color: #ff0000; color: #fff; border: 2px solid #ff0000; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;"><i class="fas fa-trash-alt"></i> Confirmar Eliminación</button>';
            echo '</form>';
        } else {
            echo "No se encontraron resultados para el ID_empleado: " . htmlspecialchars($ID_empleado);
        }
    }

    if (isset($_POST['confirm_delete'])) {
       
        $ID_empleado = $_POST['ID_empleado'];

    
        $query = "DELETE FROM Personal_Hotel WHERE ID_empleado = $1";
        $result = pg_query_params($conexion, $query, array($ID_empleado));

        if (!$result) {
            die("Error al eliminar al empleado: " . pg_last_error());
        } else {
            echo "Empleado eliminado correctamente.";
        }
    }

    pg_close($conexion);
}
?>


