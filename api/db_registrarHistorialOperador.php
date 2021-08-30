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
    $id_status = $_GET['id_status'];
    $sql = "select tb_sacep_historial_operadores.* from tb_sacep_historial_operadores where tb_sacep_historial_operadores.id_operador like '". $id_operador."' and tb_sacep_historial_operadores.id_docente like '".$id_docente."' or tb_sacep_historial_operadores.id_docente = '".$id_docente."'";
    $result = mysqli_query($connection, $sql);
    $response = array();
    if (mysqli_num_rows($result) > 0) {
        $code = "reg_failed";
        $message = "Ya esta en revisión este docente por otro operador";
        $response = ['code' => $code, 'message' => $message];
        echo json_encode($message);
    } else {
        $sql = "Insert into tb_sacep_historial_operadores(id_operador, id_docente, id_status) values ('".$id_operador."', '" . $id_docente . "', '" . $id_status . "')";
        $result = mysqli_query($connection, $sql);

        $code = "reg_success";
        $message = "Se ha registrado exitosamente";
        $response = [
            'id_operador' => $id_operador,
            'id_docente' => $id_docente,
            'id_status' => $id_status,
            'id_operador_sacep' => $connection->insert_id
        ];

        echo json_encode($response);
    }
}
