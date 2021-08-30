<?php

require "db_conexion_server.php";
if (isset($_SERVER['HTTP_ORIGIN'])) {

    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Max-Age: 86400');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']));
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']));
    header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha_sesion_finalizada = date('Y-m-d H:i:s');
    $data = json_decode(file_get_contents("php://input"));
    $sql = $connection->query("INSERT INTO tb_sacep_sesion_finalizada (fecha_sesion_finalizada, id_usuario) VALUES ('".$fecha_sesion_finalizada."', '".$data->id_usuario."')");
    if ($sql) {
        $data->id_control_sesiones_finalizadas = $con->insert_id;
        exit(json_encode($data));
    } else {
        exit(json_encode(array('status' => 'error')));
    }
}
?>