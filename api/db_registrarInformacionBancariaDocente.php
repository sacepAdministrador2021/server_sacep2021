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
    $id_banco  = $_GET['id_banco'];
    $numero_cuenta  = $_GET['numero_cuenta'];
    $clabe_interbancaria  = $_GET['clabe_interbancaria'];
    $numero_plastico  = $_GET['numero_plastico'];
    $id_usuario  = $_GET['id_usuario'];
    $sql = "Select * from tb_sacep_informacion_bancaria where id_usuario like '" . $id_usuario . "'";
    $result = mysqli_query($connection, $sql);
    $response = array();
    if (mysqli_num_rows($result) > 0) {
        $code = "reg_failed";
        $message = "Ya existe un registro bancario de este usuario...";
        $response = ['code' => $code, 'message' => $message];
        echo json_encode($message);
    } else {
        $sql = "Insert into tb_sacep_informacion_bancaria ( id_banco, numero_cuenta, clabe_interbancaria, numero_plastico, id_usuario) values ('" . $id_banco . "', '" . $numero_cuenta . "', '".$clabe_interbancaria."', '".$numero_plastico."', '".$id_usuario."')";
        $result = mysqli_query($connection, $sql);
        $code = "reg_success";
        $message = "Se ha guardado su informacion exitosamente";
        $response = ['id_informacion_bancaria' => $connection->insert_id];
        echo json_encode($response);
    }
}