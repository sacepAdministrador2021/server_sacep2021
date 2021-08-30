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

if ($postjson['sacep'] == 'sacept1') {
    $data = array();
    $query = mysqli_query($connection, "SELECT
    tb_sacep_informacion_docente.*,
    tb_sacep_nivel_estudios_docente.nombre_nivel,
    tb_sacep_pais.nombre_pais,
    tb_sacep_estados.nombre_estado,
    tb_sacep_edades.num_edad,
    tb_sacep_usuario.*
FROM
    tb_sacep_informacion_docente,
    tb_sacep_nivel_estudios_docente,
    tb_sacep_pais,
    tb_sacep_estados,
    tb_sacep_edades,
    tb_sacep_usuario
WHERE
    tb_sacep_informacion_docente.id_usuario = '$postjson[id_usuario]' AND tb_sacep_nivel_estudios_docente.id_nivel_estudio_docente = tb_sacep_informacion_docente.id_nivel_estudio AND tb_sacep_pais.id_pais = tb_sacep_informacion_docente.id_pais AND tb_sacep_estados.id_estado = tb_sacep_informacion_docente.id_estado AND tb_sacep_edades.id_edad = tb_sacep_informacion_docente.id_edad and tb_sacep_usuario.id_usuario = tb_sacep_informacion_docente.id_usuario");

    while ($row = mysqli_fetch_array($query)) {

        $data[] = array(
            'id_informacion_docente'   => $row['id_informacion_docente'],
            'numero_celular' => $row['numero_celular'],
            'nombre_nivel' => $row['nombre_nivel'],
            'nombre_pais' => $row['nombre_pais'],
            'nombre_estado' => $row['nombre_estado'],
            'num_edad' => $row['num_edad'],
            'nombre_usuario' => $row['nombre_usuario'],
            'apellido_materno_usuario' => $row['apellido_materno_usuario'],
            'apellido_paterno_usuario' => $row['apellido_paterno_usuario'],
            'genero_usuario' => $row['genero_usuario'],
            'correo_electronico_usuario' => $row['correo_electronico_usuario'],
            'fecha_nacimiento_usuario' => $row['fecha_nacimiento_usuario'],
            'foto_usuario' => $row['foto_usuario']
        );
    }

    if ($query) {
        $result = json_encode(array('success' => true, 'result' => $data));}
    else{
        $result = json_encode(array('success' => false));}
    

    echo $result;
}