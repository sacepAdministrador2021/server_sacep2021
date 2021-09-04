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

if ($postjson['sacep'] == 'sacepia') {
    $data = array();
    $query = mysqli_query($connection, "SELECT tb_sacep_informacion_alumno.*, tb_sacep_pais.nombre_pais, tb_sacep_estados.nombre_estado, tb_sacep_edades.num_edad FROM tb_sacep_informacion_alumno, tb_sacep_pais, tb_sacep_estados, tb_sacep_edades WHERE tb_sacep_informacion_alumno.id_usuario = '$postjson[id_usuario]' and tb_sacep_pais.id_pais = tb_sacep_informacion_alumno.id_pais and tb_sacep_estados.id_estado = tb_sacep_informacion_alumno.id_estado and tb_sacep_edades.id_edad = tb_sacep_informacion_alumno.id_edad");

    while ($row = mysqli_fetch_array($query)) {

        $data[] = array(
            'id_informacion_alumno' => $row['id_informacion_alumno'],
            'id_pais' => $row['id_pais'],
            'id_estado' => $row['id_estado'],
            'id_edad' => $row['id_edad'],
            'numero_celular' => $row['numero_celular'],
            'id_usuario' => $row['id_usuario'],
            'nombre_pais' => $row['nombre_pais'],
            'nombre_estado' => $row['nombre_estado'],
            'num_edad' => $row['num_edad']
        );
    }

    if ($query) {
        $result = json_encode(array('success' => true, 'result' => $data));}
    else{
        $result = json_encode(array('success' => false));}
    

    echo $result;
}