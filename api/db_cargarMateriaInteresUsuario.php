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
    $query = mysqli_query($connection, "SELECT tb_sacep_materias.nombre_materia, tb_sacep_nivelestudios.nombre_nivelestudios, tb_sacep_gradosestudios.nombre_gradoEstudio, tb_sacep_materias_interes_usuario.* FROM tb_sacep_materias_interes_usuario, tb_sacep_materias, tb_sacep_nivelestudios, tb_sacep_gradosestudios WHERE tb_sacep_materias_interes_usuario.id_usuario = '$postjson[id_usuario]' AND tb_sacep_materias_interes_usuario.id_materiaEstudio = tb_sacep_materias.id_materias AND tb_sacep_nivelestudios.id_nivelestudios = tb_sacep_materias_interes_usuario.id_nivelEstudio AND tb_sacep_gradosestudios.id_gradoEstudio = tb_sacep_materias_interes_usuario.id_gradoEstudio");

    while ($row = mysqli_fetch_array($query)) {

        $data[] = array(
            'nombre_materia'   => $row['nombre_materia'],
            'nombre_nivelestudios' => $row['nombre_nivelestudios'],
            'nombre_gradoEstudio' => $row['nombre_gradoEstudio'],
            'id_materia_interes' => $row['id_materia_interes'],
            'id_gradoEstudio' => $row['id_gradoEstudio'],
            'id_nivelEstudio' => $row['id_nivelEstudio'],
            'id_materiaEstudio' => $row['id_materiaEstudio'],
            'id_usuario' => $row['id_usuario']
        );
    }

    if ($query) {
        $result = json_encode(array('success' => true, 'result' => $data));}
    else{
        $result = json_encode(array('success' => false));}
    

    echo $result;
}