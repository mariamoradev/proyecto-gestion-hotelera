<?php
$connection_obj = mysqli_connect("localhost", "root","","electo_majo");

if(!$connection_obj)
{
    echo "Error No: ".mysqli_connect_errno();
    echo "Error Descripcion: ".mysqli_connect_error();
    exit;
}

$use=$_POST['user'];
$pass=$_POST['pass'];
$nuevo=$_POST['usernuevo'];
$nuevo2=$_POST['passnuevo'];



$query = "UPDATE TB_DATAUSER SET Clave = '$nuevo2', Email = '$nuevo' WHERE Email = '$use' AND Clave = '$pass'";

    $resul = mysqli_query($connection_obj,$query) or die(mysqli_error($connection_obj));
    if ($resul) {
        echo "Actualizacion bien";
    } else {
        echo "Error al ejecutar la consulta: " . mysqli_error($connection_obj);
    }

mysqli_close($connection_obj);

?>
