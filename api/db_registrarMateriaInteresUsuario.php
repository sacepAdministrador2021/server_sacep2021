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
    $id_gradoEstudio = $_GET['id_gradoEstudio'];
    $id_nivelEstudio = $_GET['id_nivelEstudio'];
    $id_materiaEstudio = $_GET['id_materiaEstudio'];
    $id_usuario = $_GET['id_usuario'];
    $sql = "Select * from tb_sacep_materias_interes_usuario where id_usuario like '" . $id_usuario . "'";
    $result = mysqli_query($connection, $sql);
    $response = array();
    if (mysqli_num_rows($result) > 0) {
        $code = "reg_failed";
        $message = "Ya tiene una materia de interes...";
        $response = ['code' => $code, 'message' => $message];
        echo json_encode($message);
    } else {
        $sql = "Insert into tb_sacep_materias_interes_usuario(id_gradoEstudio, id_nivelEstudio, id_materiaEstudio, id_usuario) values ('" . $id_gradoEstudio . "', '" . $id_nivelEstudio . "', '" . $id_materiaEstudio . "', '". $id_usuario ."')";
    $result = mysqli_query($connection, $sql);
    $code = "reg_success";
    $message = "Se ha registrado exitosamente";
    $response = [
        'id_gradoEstudio' => $id_gradoEstudio,
        'id_nivelEstudio' => $id_nivelEstudio,
        'id_materiaEstudio' => $id_materiaEstudio,
        'id_usuario' => $id_usuario,
        'id_materia_interes' => $connection->insert_id
    ];
    echo json_encode($response);
    }
}
