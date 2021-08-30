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
    $id_documentacion = $_GET['id_documentacion'];
    $id_usuario = $_GET['id_usuario'];
    $sql = "Select * from tb_sacep_documentacion_docente where id_documentacion like '" . $id_documentacion . "'  and id_usuario like '" . $id_usuario . "'";
    $result = mysqli_query($connection, $sql);
    $response = array();
    if (mysqli_num_rows($result) > 0) {
        $code = "reg_failed";
        $message = "Ya ha enviado este documento a revision";
        $response = ['code' => $code, 'message' => $message];
        echo json_encode($message);
    } else {
        $code = "reg_success";
        $message = "No hay datos";
        $response = ['code' => $code, 'message' => $message];
        echo json_encode($message);
    }
}
