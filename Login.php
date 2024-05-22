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
$rol=$_POST['rol'];

$query = "SELECT * FROM TB_DATAUSER WHERE Email ='$use' AND Clave ='$pass'";
$resul = mysqli_query($connection_obj,$query) or die(mysqli_error($connection_obj));
if ($row=mysqli_fetch_array($resul,MYSQLI_BOTH)){
    if($rol=='1')
    {
        $v='Admin.html';
        header('Location: '.$v);
    }
    if($rol=='2')
    {
        $v='Otro.html';
        header('Location: '.$v);
    }
}else{
    echo "Usuario y contraseña Incorrecto";
}

mysqli_close($connection_obj);

?>