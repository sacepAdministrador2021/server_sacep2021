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
    $id_nivel_estudio  = $_GET['id_nivel_estudio'];
    $id_pais  = $_GET['id_pais'];
    $id_estado  = $_GET['id_estado'];
    $id_edad  = $_GET['id_edad'];
    $numero_celular  = $_GET['numero_celular'];
    $id_usuario = $_GET['id_usuario'];
    $sql = "Select * from tb_sacep_informacion_docente where numero_celular like '" . $numero_celular . "'  or id_usuario like '" . $id_usuario . "'";
    $result = mysqli_query($connection, $sql);
    $response = array();
    if (mysqli_num_rows($result) > 0) {
        $code = "reg_failed";
        $message = "Ya existe un registro de este usuario...";
        $response = ['code' => $code, 'message' => $message];
        echo json_encode($message);
    } else {
        $sql = "Insert into tb_sacep_informacion_docente ( id_nivel_estudio, id_pais, id_estado, id_edad, numero_celular, id_usuario) values ('" . $id_nivel_estudio . "', '" . $id_pais . "', '".$id_estado."', '".$id_edad."', '".$numero_celular."', '".$id_usuario."')";
        $result = mysqli_query($connection, $sql);
        $code = "reg_success";
        $message = "Se ha guardado su informacion exitosamente";
        $response = ['id_informacion_docente' => $connection->insert_id];
        echo json_encode($response);
    }
}