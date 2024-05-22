<?php
// Datos de conexión
$host = 'localhost';
$dbname = 'GESTIONHOTELMJ';
$user = 'postgres';
$password = 'junior';

// Conexión a PostgreSQL
$conexion = pg_connect("host=$host dbname=$dbname user=$user password=$password");

if ($conexion) {
    echo 'Conexión exitosa';
} else {
    echo 'No se pudo conectar: ' . pg_last_error();
    exit; // Detener el script si no hay conexión
}

// Recoger los datos del formulario
$nombre = $_POST['nombre'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$cantidad = $_POST['cantidad'];
$comida = $_POST['comida'];


// Consulta SQL para insertar datos en la tabla 'Reserva_Evento'
$queryInsert = "INSERT INTO Reserva_Restaurante (Nombre, Fecha, Hora, Cantidad_personas, Tipo_comida) VALUES ('$nombre', '$fecha', '$hora', '$cantidad', '$comida')";

// Ejecutar la consulta de inserción
$resultadoInsert = pg_query($conexion, $queryInsert);

// Verificar si la inserción fue exitosa
if ($resultadoInsert) {
    echo 'Datos insertados correctamente';
} else {
    echo 'Error al insertar datos: ' . pg_last_error($conexion);
}

// Cerrar la conexión
pg_close($conexion);
?>