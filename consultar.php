<?php

$host = 'localhost';
$dbname = 'GESTIONHOTELMJ';
$user = 'postgres';
$password = 'junior';


$conexion = pg_connect("host=$host dbname=$dbname user=$user password=$password");

if ($conexion) {
    echo 'Conexión exitosa<br>';
} else {
    echo 'No se pudo conectar: ' . pg_last_error();
    exit; 
}



$ID_empleado = $_POST['ID_empleado'];

if (!is_numeric($ID_empleado)) {
    die("El ID_empleado proporcionado no es válido.");
}


$query = "SELECT * FROM Personal_Hotel WHERE ID_empleado = $1";


$result = pg_query_params($conexion, $query, array($ID_empleado));

if (!$result) {
    die("Error en la consulta SQL: " . pg_last_error());
}

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
        animation: fadeInDown 1s ease-in-out, colorChange 2s infinite alternate;
    }
    table {
        width: 80%;
        border-collapse: collapse;
        margin: 0 auto;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        animation: fadeInUp 1s ease-in-out;
    }
    th, td {
        padding: 15px;
        text-align: left;
        border: 2px solid #4CAF50;
    }
    th {
        background-color: #4CAF50;
        color: white;
        width: 50%;
    }
    td {
        width: 50%;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #d1ffd1;
        transition: background-color 0.3s ease-in-out;
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
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
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
</style>';

echo '<h1>Información del Empleado</h1>';

if (pg_num_rows($result) > 0) {
    while ($row = pg_fetch_assoc($result)) {
        echo '<table>';
        echo '<tr><th>ID Empleado</th><td>' . htmlspecialchars($row['id_empleado']) . '</td></tr>';
        echo '<tr><th>Nombres</th><td>' . htmlspecialchars($row['nombres']) . '</td></tr>';
        echo '<tr><th>Apellidos</th><td>' . htmlspecialchars($row['apellidos']) . '</td></tr>';
        echo '<tr><th>Cedula</th><td>' . htmlspecialchars($row['cedula']) . '</td></tr>';
        echo '<tr><th>Fecha de Contrato</th><td>' . htmlspecialchars($row['fecha_contrato']) . '</td></tr>';
        echo '<tr><th>Fecha de Finalización de Contrato</th><td>' . htmlspecialchars($row['fecha_finalizacion_contrato']) . '</td></tr>';
        echo '<tr><th>Horas de Trabajo</th><td>' . htmlspecialchars($row['horas_trabajo']) . '</td></tr>';
        echo '<tr><th>Capacitaciones</th><td>' . htmlspecialchars($row['capacitaciones']) . '</td></tr>';
        echo '<tr><th>Jornada de Trabajo</th><td>' . htmlspecialchars($row['jornada_trabajo']) . '</td></tr>';
        echo '<tr><th>Salario</th><td>' . htmlspecialchars($row['salario']) . '</td></tr>';
        echo '<tr><th>Estado del Contrato</th><td>' . htmlspecialchars($row['estado_contrato']) . '</td></tr>';
        echo '<tr><th>Nomina</th><td>' . htmlspecialchars($row['nomina']) . '</td></tr>';
        echo '<tr><th>Turnos</th><td>' . htmlspecialchars($row['turnos']) . '</td></tr>';
        echo '</table><br>';
    }
} else {
    echo "No se encontraron resultados para el ID_empleado: " . htmlspecialchars($ID_empleado);
}


pg_close($conexion);
?>