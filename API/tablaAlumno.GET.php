<?php
// Cabecera JSON
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Respuesta por defecto
$respuesta = [
    'success' => false,
    'data' => [],
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

// Obtener el DNI del alumno desde los parámetros de la URL
if (!isset($_GET['dni_alum'])) {
    $respuesta['error'] = 'Error en los datos recibidos';
    echo json_encode($respuesta);
    exit;
}

$dni_alum = $_GET['dni_alum'];


$sql = "SELECT id_entrada, fecha, tipo_practica, total_horas, actividad, observaciones FROM EntradaPractica WHERE dni_alum = ?";

// Preparar y ejecutar la sentencia
if ($stmt = mysqli_prepare($con, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $dni_alum);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Obtener resultados
    $entradas = [];
    while ($fila = mysqli_fetch_assoc($result)) {
        $entradas[] = $fila;
    }

    if ($entradas) {
        $respuesta['success'] = true;
        $respuesta['data'] = $entradas;
    } else {
        $respuesta['error'] = 'No se encontraron entradas para el alumno';
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
