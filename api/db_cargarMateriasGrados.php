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

if ($postjson['sacep'] == 'sacepNE') {
    $data = array();
    $query = mysqli_query($connection, "select tb_sacep_materias_grados.*, tb_sacep_materias.nombre_materia from tb_sacep_materias_grados, tb_sacep_materias where tb_sacep_materias_grados.id_grado = '$postjson[id_grado]' and tb_sacep_materias.id_materias = tb_sacep_materias_grados.id_materia");

    while ($row = mysqli_fetch_array($query)) {

        $data[] = array(
            'id_grado'   => $row['id_grado'],
            'id_materia' => $row['id_materia'],
            'nombre_materia' => $row['nombre_materia']
        );
    }

    if ($query) {
        $result = json_encode(array('success' => true, 'result' => $data));}
    else{
        $result = json_encode(array('success' => false));}
    

    echo $result;
}