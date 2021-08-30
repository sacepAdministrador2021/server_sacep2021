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

if ($postjson['aksi'] == "docente"){
    $data = array();
    $query = mysqli_query($connection, "SELECT *, tb_sacep_rol.descripcion_rol FROM tb_sacep_usuario, tb_sacep_rol where tb_sacep_usuario.id_rol = 1 and tb_sacep_usuario.id_rol = tb_sacep_rol.id_rol ORDER BY id_usuario ASC");

    while($row = mysqli_fetch_array($query)){
        $data[] = array(
            'id_usuario' => $row['id_usuario'],
            'nombre_usuario' => $row['nombre_usuario'],
            'apellido_materno_usuario' => $row['apellido_materno_usuario'],
            'apellido_paterno_usuario' => $row['apellido_paterno_usuario'],
            'genero_usuario' => $row['genero_usuario'],
            'correo_electronico_usuario' => $row['correo_electronico_usuario'],
            'id_status' => $row['id_status'],
            'id_rol' => $row['id_rol'],
            'fecha_nacimiento_usuario' => $row['fecha_nacimiento_usuario'],
            'fecha_registro_usuario' => $row['fecha_registro_usuario'],
            'foto_usuario' => $row['foto_usuario'],
            'color_status' => $row['color_status'],
            'descripcion_rol' => $row['descripcion_rol']
        );
    }

    if ($query) {
        $result = json_encode(array('success'=>true, 'result'=>$data));
    } else {
        $result = json_encode(array('success'=>false));
    }
    echo $result;
}