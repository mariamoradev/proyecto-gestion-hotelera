<?php

$host = 'localhost';
$dbname = 'GESTIONHOTELMJ';
$user = 'postgres';
$password = 'junior';


$conexion = pg_connect("host=$host dbname=$dbname user=$user password=$password");

if ($conexion) {
    echo 'Conexión exitosa';
} else {
    echo 'No se pudo conectar: ' . pg_last_error();
}


if (isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['numeroidentidad']) && isset($_POST['email']) && isset($_POST['telefono']) && isset($_POST['nacionalidad']) && isset($_POST['fechanacimiento'])) {

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $numeroidentidad = $_POST['numeroidentidad'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $nacionalidad = $_POST['nacionalidad'];
    $fechanacimiento = $_POST['fechanacimiento'];

   
    $queryInsert = "INSERT INTO Cliente (Nombres, Apellidos, numeroidentificacion, Correo, Telefono, Nacionalidad, Fecha_nacimiento) VALUES ('$nombre', '$apellidos', '$numeroidentidad', '$email', '$telefono', '$nacionalidad', '$fechanacimiento')";

  
    $resultadoInsert = pg_query($conexion, $queryInsert);

    if ($resultadoInsert) {
        echo 'Datos insertados correctamente';
    } else {
        echo 'Error al insertar datos: ' . pg_last_error();
    }
} else {
    echo 'No se recibieron todos los datos necesarios del formulario.';
}


pg_close($conexion);
?>
