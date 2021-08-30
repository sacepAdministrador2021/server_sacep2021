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

if ($postjson['sacepDp2'] == "infoGeneral"){
    $data = array();
    $query = mysqli_query($connection, "SELECT
    tb_sacep_status_operacion.*,
    tb_sacep_tramites_revision.nombre_tramite_revision,
    tb_sacep_status.*
FROM
    tb_sacep_status_operacion,
    tb_sacep_tramites_revision,
    tb_sacep_status
WHERE
    tb_sacep_status_operacion.id_usuario = '$postjson[id_usuario]' AND tb_sacep_tramites_revision.id_tramite_revision = tb_sacep_status_operacion.id_tramite_revision AND tb_sacep_status_operacion.tipo_status_operacion = tb_sacep_status.id_status
ORDER BY
    `tb_sacep_status_operacion`.`id_tramite_revision` ASC");
   while($row = mysqli_fetch_array($query)){
        $data[] = array(
            'id_status_operacion' => $row['id_status_operacion'],
            'tipo_status_operacion' => $row['tipo_status_operacion'],
            'id_tramite_revision' => $row['id_tramite_revision'],
            'id_usuario' => $row['id_usuario'],
            'color_statuts' => $row['color_statuts'],
            'fecha_registro_documento' => $row['fecha_registro_documento'],
            'fecha_actualizacion_documento' => $row['fecha_actualizacion_documento'],
            'nombre_tramite_revision' => $row['nombre_tramite_revision'],
            'contrasena_usuario' => $row['contrasena_usuario'],
            'id_status' => $row['id_status'],
            'tipo_status' => $row['tipo_status']
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