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

    if (isset($_POST['ID_empleado']) && !isset($_POST['update'])) {
        
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
            echo '<html><head>';
            echo '<style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f0f0f0;
                    color: #333;
                    padding: 20px;
                }
                h1 {
                    text-align: center;
                    color: #4CAF50;
                    font-size: 48px;
                    margin-bottom: 20px;
                    text-transform: uppercase;
                    letter-spacing: 4px;
                    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
                    font-family: "Comic Sans MS", cursive, sans-serif;
                    animation: fadeInDown 1s ease-in-out, colorChange 3s infinite alternate;
                }
                form {
                    background: white;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    max-width: 600px;
                    margin: 0 auto;
                }
                form label {
                    display: block;
                    margin: 10px 0 5px;
                    color: #4CAF50;
                }
                form input[type="text"],
                form input[type="date"],
                form input[type="submit"] {
                    width: 100%;
                    padding: 10px;
                    margin-bottom: 20px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                }
                form input[type="submit"] {
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                }
                form input[type="submit"]:hover {
                    background-color: #45a049;
                }
                @keyframes fadeInDown {
                    from {
                        opacity: 0;
                        transform: translateY(-20px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
                @keyframes colorChange {
                    from {
                        color: #4CAF50;
                    }
                    to {
                        color: #FF5733;
                    }
                }
                </style></head><body>';
            echo '<h1>Modificar Empleado</h1>';
            echo '<form action="modificar_empleado.php" method="post">';
            echo '<label for="nombres">Nombres:</label><input type="text" name="nombres" value="' . htmlspecialchars($row['nombres']) . '"><br>';
            echo '<label for="apellidos">Apellidos:</label><input type="text" name="apellidos" value="' . htmlspecialchars($row['apellidos']) . '"><br>';
            echo '<label for="cedula">Cédula:</label><input type="text" name="cedula" value="' . htmlspecialchars($row['cedula']) . '"><br>';
            echo '<label for="fecha_contrato">Fecha de Contrato:</label><input type="date" name="fecha_contrato" value="' . htmlspecialchars($row['fecha_contrato']) . '"><br>';
            echo '<label for="fecha_finalizacion_contrato">Fecha de Finalización de Contrato:</label><input type="date" name="fecha_finalizacion_contrato" value="' . htmlspecialchars($row['fecha_finalizacion_contrato']) . '"><br>';
            echo '<label for="horas_trabajo">Horas de Trabajo:</label><input type="text" name="horas_trabajo" value="' . htmlspecialchars($row['horas_trabajo']) . '"><br>';
            echo '<label for="capacitaciones">Capacitaciones:</label><input type="text" name="capacitaciones" value="' . htmlspecialchars($row['capacitaciones']) . '"><br>';
            echo '<label for="jornada_trabajo">Jornada de Trabajo:</label><input type="text" name="jornada_trabajo" value="' . htmlspecialchars($row['jornada_trabajo']) . '"><br>';
            echo '<label for="salario">Salario:</label><input type="text" name="salario" value="' . htmlspecialchars($row['salario']) . '"><br>';
            echo '<label for="estado_contrato">Estado del Contrato:</label><input type="text" name="estado_contrato" value="' . htmlspecialchars($row['estado_contrato']) . '"><br>';
            echo '<label for="nomina">Nómina:</label><input type="text" name="nomina" value="' . htmlspecialchars($row['nomina']) . '"><br>';
            echo '<label for="turnos">Turnos:</label><input type="text" name="turnos" value="' . htmlspecialchars($row['turnos']) . '"><br>';
            echo '<input type="hidden" name="ID_empleado" value="' . htmlspecialchars($row['id_empleado']) . '">';
            echo '<input type="hidden" name="update" value="true">';
            echo '<input type="submit" value="Modificar">';
            echo '</form>';
            echo '</body></html>';
        } else {
            echo "No se encontraron resultados para el ID_empleado: " . htmlspecialchars($ID_empleado);
        }
    }

    if (isset($_POST['update'])) {
       
        $ID_empleado = $_POST['ID_empleado'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $cedula = $_POST['cedula'];
        $fecha_contrato = $_POST['fecha_contrato'];
        $fecha_finalizacion_contrato = $_POST['fecha_finalizacion_contrato'];
        $horas_trabajo = $_POST['horas_trabajo'];
        $capacitaciones = $_POST['capacitaciones'];
        $jornada_trabajo = $_POST['jornada_trabajo'];
        $salario = $_POST['salario'];
        $estado_contrato = $_POST['estado_contrato'];
        $nomina = $_POST['nomina'];
        $turnos = $_POST['turnos'];

        
        $query = "UPDATE Personal_Hotel SET 
                    nombres = $1, 
                    apellidos = $2, 
                    cedula = $3, 
                    fecha_contrato = $4, 
                    fecha_finalizacion_contrato = $5, 
                    horas_trabajo = $6, 
                    capacitaciones = $7, 
                    jornada_trabajo = $8, 
                    salario = $9, 
                    estado_contrato = $10, 
                    nomina = $11, 
                    turnos = $12 
                  WHERE id_empleado = $13";

        $result = pg_query_params($conexion, $query, array(
            $nombres, 
            $apellidos, 
            $cedula, 
            $fecha_contrato, 
            $fecha_finalizacion_contrato, 
            $horas_trabajo, 
            $capacitaciones, 
            $jornada_trabajo, 
            $salario, 
            $estado_contrato, 
            $nomina, 
            $turnos, 
            $ID_empleado
        ));

        if (!$result) {
            die("Error en la consulta SQL: " . pg_last_error());
        } else {
            echo "Datos del empleado actualizados correctamente.";
        }
    }

    
    pg_close($conexion);
}
?>
