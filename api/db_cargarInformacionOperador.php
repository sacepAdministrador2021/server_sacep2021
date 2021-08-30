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

if ($postjson['sacepOperador'] == 'operador') {
    $data = array();
    $query = mysqli_query($connection, "select tb_sacep_operadores.*, tb_sacep_rol.descripcion_rol, tb_sacep_status.tipo_status from tb_sacep_operadores, tb_sacep_rol, tb_sacep_status where tb_sacep_operadores.id_operador_sacep = '$postjson[id_usuario]' and tb_sacep_rol.id_rol = tb_sacep_operadores.id_rol and tb_sacep_status.id_status = tb_sacep_operadores.id_status");

    while ($row = mysqli_fetch_array($query)) {

        $data[] = array(
            'id_operador_sacep' => $row['id_operador_sacep'],
            'num_empleado'   => $row['num_empleado'],
            'nombre_operador' => $row['nombre_operador'],
            'apellido_materno_operador' => $row['apellido_materno_operador'],
            'apellido_paterno_operador' => $row['apellido_paterno_operador'],
            'genero_operador' => $row['genero_operador'],
            'dia_operador' => $row['dia_operador'],
            'mes_operador' => $row['mes_operador'],
            'year_operador' => $row['year_operador'],
            'fecha_nacimiento_operador' => $row['fecha_nacimiento_operador'],
            'foto_operador' => $row['foto_operador'],
            'fecha_registro_operador' => $row['fecha_registro_operador'],
            'correo_operador' => $row['correo_operador'],
            'color_status' => $row['color_status'],
            'descripcion_rol' => $row['descripcion_rol'],
            'tipo_status' => $row['tipo_status']
        );
    }

    if ($query) {
        $result = json_encode(array('success' => true, 'result' => $data));}
    else{
        $result = json_encode(array('success' => false));}
    

    echo $result;
}