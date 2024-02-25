<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$respuesta = ['success' => false, 'data' => null, 'error' => ''];

$host = 'servidorxemi.mysql.database.azure.com';
$username = 'xemita';
$password = 'Posnose90';
$dbname = 'GestorPracticas';
$port = 3306;

$con = mysqli_connect($host, $username, $password, $dbname, $port);

if (!$con) {
    $respuesta['error'] = 'No se ha podido conectar con la base de datos: ' . mysqli_connect_error();
    echo json_encode($respuesta);
    exit;
}

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

// Asumiendo que el dni_alum ahora viene del cuerpo de la petición
if ($data === null || !isset($data['dni_alum']) || !isset($data['fecha']) || !isset($data['tipo_practica']) || !isset($data['total_horas']) || !isset($data['actividad'])) {
    $respuesta['error'] = 'Error en los datos recibidos';
    echo json_encode($respuesta);
    exit;
}

$dni_alum = $data['dni_alum'];
$fecha = $data['fecha'];
$tipoPractica = $data['tipo_practica'];
$totalHoras = $data['total_horas'];
$actividad = $data['actividad'];
$observaciones = isset($data['observaciones']) ? $data['observaciones'] : '';

$sql = "INSERT INTO EntradaPractica (fecha, tipo_practica, total_horas, actividad, observaciones, dni_alum) VALUES (?, ?, ?, ?, ?, ?)";

if ($stmt = mysqli_prepare($con, $sql)) {
    mysqli_stmt_bind_param($stmt, "ssisss", $fecha, $tipoPractica, $totalHoras, $actividad, $observaciones, $dni_alum);
    $success = mysqli_stmt_execute($stmt);
    
    if ($success) {
        $respuesta['success'] = true;
        $respuesta['data'] = 'Entrada creada con éxito';
    } else {
        $respuesta['error'] = 'Error al crear la entrada';
    }

    mysqli_stmt_close($stmt);
} else {
    $respuesta['error'] = 'Error al preparar la consulta: ' . mysqli_error($con);
}

mysqli_close($con);
echo json_encode($respuesta);
?>
