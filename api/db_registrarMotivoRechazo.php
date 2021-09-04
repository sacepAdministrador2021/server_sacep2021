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
    $id_operador = $_GET['id_operador'];
    $id_docente = $_GET['id_docente'];
    $id_documento = $_GET['id_documento'];
    $motivo_rechazo = $_GET['motivo_rechazo'];
    $sql = "Select * from tb_sacep_motivos_rechazo_documentacion where id_docente like '" . $id_docente . "'  and id_documento like '" . $id_documento . "'";
    $result = mysqli_query($connection, $sql);
    $response = array();
    if (mysqli_num_rows($result) > 0) {
        $code = "reg_failed";
        $message = "Ya hay una observación solo se puede actualizar la información una vez...";
        $response = ['code' => $code, 'message' => $message];
        echo json_encode($message);
    } else {
        $sql = "Insert into tb_sacep_motivos_rechazo_documentacion(motivo_rechazo, id_documento, id_docente, id_operador) values ('" . $motivo_rechazo . "', '" . $id_documento . "', '" . $id_docente . "', '". $id_operador ."')";
    $result = mysqli_query($connection, $sql);
    $code = "reg_success";
    $message = "Se ha registrado exitosamente";
    $response = [
        'motivo_rechazo' => $motivo_rechazo,
        'id_documento' => $id_documento,
        'id_docente' => $id_docente,
        'id_operador' => $id_operador,
        'id_motivo' => $connection->insert_id
    ];
    echo json_encode($response);
    }
}
