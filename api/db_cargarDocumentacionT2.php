<?php

require "db_conexion_server.php";
if(isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Max-Age: 86400');
}

if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
    if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']));
        header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
        if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']));
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
                exit(0);
}

$postjson = json_decode(file_get_contents('php://input'), true);

if ($postjson['sacep'] == 'sacept2') {
    $data = array();
    $query = mysqli_query($connection, "SELECT
    tb_sacep_informacion_bancaria.*,
    tb_sacep_bancos.nombre_banco
FROM
    tb_sacep_informacion_bancaria,
    tb_sacep_bancos
WHERE
    tb_sacep_informacion_bancaria.id_usuario = '$postjson[id_usuario]' AND tb_sacep_informacion_bancaria.id_banco = tb_sacep_bancos.id_banco");

    while ($row = mysqli_fetch_array($query)) {

        $data[] = array(
            'id_informacion_bancaria'   => $row['id_informacion_bancaria'],
            'id_banco' => $row['id_banco'],
            'numero_cuenta' => $row['numero_cuenta'],
            'clabe_interbancaria' => $row['clabe_interbancaria'],
            'numero_plastico' => $row['numero_plastico'],
            'nombre_banco' => $row['nombre_banco']
        );
    }

    if ($query) {
        $result = json_encode(array('success' => true, 'result' => $data));}
    else{
        $result = json_encode(array('success' => false));}
    

    echo $result;
}