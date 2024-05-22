<?php
// Datos de conexión
$host = 'localhost';
$dbname = 'GESTIONHOTELMJ';
$user = 'postgres';
$password = 'junior';

// Conexión a PostgreSQL
$conexion = pg_connect("host=$host dbname=$dbname user=$user password=$password");

if ($conexion) {
    echo '<h2>Conexión exitosa</h2><br>';
} else {
    echo 'No se pudo conectar: ' . pg_last_error();
    exit; 
}


$query = "SELECT * FROM Personal_Hotel";

$result = pg_query($conexion, $query);

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
        animation: fadeInDown 1s ease-in-out, colorChange 3s infinite alternate;
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

echo '<h1>Información de Todos los Empleados</h1>';

if (pg_num_rows($result) > 0) {
    echo '<table>';
    echo '<tr>
            <th>ID Empleado</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Cédula</th>
            <th>Fecha de Contrato</th>
            <th>Fecha de Finalización de Contrato</th>
            <th>Horas de Trabajo</th>
            <th>Capacitaciones</th>
            <th>Jornada de Trabajo</th>
            <th>Salario</th>
            <th>Estado del Contrato</th>
            <th>Nómina</th>
            <th>Turnos</th>
          </tr>';
    while ($row = pg_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['id_empleado']) . '</td>';
        echo '<td>' . htmlspecialchars($row['nombres']) . '</td>';
        echo '<td>' . htmlspecialchars($row['apellidos']) . '</td>';
        echo '<td>' . htmlspecialchars($row['cedula']) . '</td>';
        echo '<td>' . htmlspecialchars($row['fecha_contrato']) . '</td>';
        echo '<td>' . htmlspecialchars($row['fecha_finalizacion_contrato']) . '</td>';
        echo '<td>' . htmlspecialchars($row['horas_trabajo']) . '</td>';
        echo '<td>' . htmlspecialchars($row['capacitaciones']) . '</td>';
        echo '<td>' . htmlspecialchars($row['jornada_trabajo']) . '</td>';
        echo '<td>' . htmlspecialchars($row['salario']) . '</td>';
        echo '<td>' . htmlspecialchars($row['estado_contrato']) . '</td>';
        echo '<td>' . htmlspecialchars($row['nomina']) . '</td>';
        echo '<td>' . htmlspecialchars($row['turnos']) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo "No se encontraron empleados.";
}

pg_close($conexion);
?>
