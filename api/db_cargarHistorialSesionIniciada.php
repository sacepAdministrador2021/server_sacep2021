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

if ($postjson['sacepSI'] == "sesionIniciada"){
    $data = array();
    $query = mysqli_query($connection, "select tb_sacep_sesion_iniciada.* from tb_sacep_sesion_iniciada where tb_sacep_sesion_iniciada.id_usuario = '$postjson[id_usuario]'");

   while($row = mysqli_fetch_array($query)){
        $data[] = array(
            'id_control_sesiones' => $row['id_control_sesiones'],
            'fecha_inicio_sesion' => $row['fecha_inicio_sesion']
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