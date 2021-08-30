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

if ($postjson['sacepDR'] == 'sacepRV') {
    $data = array();
    $query = mysqli_query($connection, "select tb_sacep_status_operacion.*, tb_sacep_status.tipo_status, tb_sacep_tramites_revision.nombre_tramite_revision, tb_sacep_status_operacion.color_statuts from tb_sacep_status, tb_sacep_tramites_revision, tb_sacep_status_operacion where tb_sacep_status_operacion.id_tramite_revision = tb_sacep_tramites_revision.id_tramite_revision and tb_sacep_status.id_status = tb_sacep_status_operacion.tipo_status_operacion and tb_sacep_status_operacion.id_usuario ='$postjson[id_usuario]'");

    while ($row = mysqli_fetch_array($query)) {

        $data[] = array(
            'tipo_status'   => $row['tipo_status'],
            'nombre_tramite_revision' => $row['nombre_tramite_revision'],
            'color_statuts' => $row['color_statuts'],
            'id_usuario' => $row['id_usuario'],
            'id_status_operacion' => $row['id_status_operacion']
        );
    }

    if ($query) {
        $result = json_encode(array('success' => true, 'result' => $data));}
    else{
        $result = json_encode(array('success' => false));}
    

    echo $result;
}