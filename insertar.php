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


$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$cargo = $_POST['cargo'];
$fecha_contrato = $_POST['fecha_contrato'];
$fecha_fin_contrato= $_POST['fecha_fin_contrato'];
$horas_trabajo = $_POST['horas_trabajo'];
$capacitaciones = $_POST['capacitaciones'];
$jornada_trabajo = $_POST['jornada_trabajo'];
$salario = $_POST['salario'];
$estado_contrato = $_POST['estado_contrato'];
$nomina = $_POST['nomina'];
$turnos = $_POST['turnos'];
$cedula = $_POST['cedula'];



$queryInsert = "INSERT INTO Personal_Hotel (Nombres, Apellidos, Cargo, Fecha_contrato, Fecha_finalizacion_contrato, Horas_trabajo, Capacitaciones, Jornada_trabajo, Salario, Estado_contrato, Nomina, Turnos, Cedula) VALUES ('$nombre', '$apellidos', '$cargo', '$fecha_contrato', '$fecha_fin_contrato', '$horas_trabajo', '$capacitaciones', '$jornada_trabajo', '$salario', '$estado_contrato', '$nomina', '$turnos', '$cedula')";


$resultadoInsert = pg_query($conexion, $queryInsert);


if ($resultadoInsert) {
echo 'Datos insertados correctamente';
} else {
echo 'Error al insertar datos';
}

pg_close($conexion);
?>