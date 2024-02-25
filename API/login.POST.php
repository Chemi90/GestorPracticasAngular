<?php
// Cabecera JSON
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


// Respuesta por defecto
$respuesta = [
    'success' => false,
    'data' => null,
    'error' => ''
];

// Conexión a la base de datos con mysqli
$host = 'servidorxemi.mysql.database.azure.com'; // Tu servidor de Azure
$username = 'xemita'; // Usuario de Azure
$password = 'Posnose90'; // Contraseña
$dbname = 'GestorPracticas'; // Nombre de la base de datos
$port = 3306; // Puerto

$con = mysqli_connect($host, $username, $password, $dbname, $port);

// Verificar conexión
if (!$con) {
    $respuesta['error'] = 'No se ha podido conectar con la base de datos: ' . mysqli_connect_error();
    echo json_encode($respuesta);
    exit;
}

// Recibimos los datos por JSON
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

// Verificar si la decodificación JSON fue exitosa y si se recibieron los datos necesarios
if ($data === null || !isset($data['nom_alum']) || !isset($data['contra_alum'])) {
    $respuesta['error'] = 'Error en los datos recibidos';
    echo json_encode($respuesta);
    exit;
}

// Acceder a los datos del objeto JSON
$usuarioLogeado = $data['nom_alum'];
$usuarioClave = $data['contra_alum'];

$sql = "SELECT dni_alum, nom_alum FROM Alumno WHERE nom_alum = ? AND contra_alum = ?";

// Preparar y ejecutar la sentencia
if ($stmt = mysqli_prepare($con, $sql)) {
    mysqli_stmt_bind_param($stmt, "ss", $usuarioLogeado, $usuarioClave);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Obtener resultados
    $resultado = mysqli_fetch_assoc($result);

    if ($resultado) {
        $respuesta['success'] = true;
        $respuesta['data'] = $resultado;
    } else {
        $respuesta['error'] = 'Usuario o clave incorrecta';
    }

    // Cerrar la sentencia
    mysqli_stmt_close($stmt);
} else {
    $respuesta['error'] = 'Error al preparar la consulta: ' . mysqli_error($con);
}

// Cerrar la conexión
mysqli_close($con);

echo json_encode($respuesta);
?>
