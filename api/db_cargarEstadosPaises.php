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

$postjson = json_decode(file_get_contents('php://input'), true);

if ($postjson['sacepEPS'] == "estadosPaises"){
    $data = array();
    $query = mysqli_query($connection, "select tb_sacep_estadospais.id_estado, tb_sacep_estados.nombre_estado, tb_sacep_pais.nombre_pais from tb_sacep_estados, tb_sacep_estadospais, tb_sacep_pais where tb_sacep_estados.id_estado = tb_sacep_estadospais.id_estado and tb_sacep_estadospais.id_pais = tb_sacep_pais.id_pais and tb_sacep_estadospais.id_pais = '$postjson[id_pais]'");

   while($row = mysqli_fetch_array($query)){
        $data[] = array(
            'id_estado' => $row['id_estado'],
            'nombre_estado' => $row['nombre_estado']
        );
    }
    if($query) {
        $result = json_encode(array('success'=>true, 'result'=>$data));
    } 
    else {
        $result = json_encode(array('success'=>false));
    }
    echo $result;
}
?>