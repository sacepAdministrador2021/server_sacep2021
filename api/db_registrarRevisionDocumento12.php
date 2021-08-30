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

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $tipo_status_operacion = 5;
    $id_tramite_revision = 12;   
    $id_usuario  = $_GET['id_usuario'];
    $color_statuts = "revision";
    $fecha = date('Y-m-d H:i:s');
        $sql = "Insert into tb_sacep_status_operacion ( tipo_status_operacion, id_tramite_revision, id_usuario, color_statuts, fecha_registro_documento) values ('" . $tipo_status_operacion . "', '" . $id_tramite_revision . "', '".$id_usuario."', '".$color_statuts."', '".$fecha."')";
        $result = mysqli_query($connection, $sql);
        $code = "reg_success";
        $message = "Se ha actualizado el estado de Otros";
        $response = ['id_tramite_revision' => $connection->insert_id];
        echo json_encode($response);
    
}