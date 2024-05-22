<?php



// Datos de conexión
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


$email = $_POST['email'];
$password = $_POST['password'];


$query = $db->prepare("SELECT * FROM usuario WHERE email = :email");
$query->execute(['email' => $email]);

$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {

    switch ($user['rol']) {
        case 'Admin':
            header("Location: admin_general.html");
            break;
        case 'Cliente':
            header("Location: index.html");
            break;
        case 'RecursosHumanos':
            header("Location: RecursosHumanos.html");
            break;
        
            break;
    }
} else {
    echo "Credenciales incorrectas.";
}
?>