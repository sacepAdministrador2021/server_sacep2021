<?php

require "db_conexion_server.php";
if (isset($_SERVER['HTTP_ORIGIN'])) {

    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Max-Age: 86400');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']));
    header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']));
    header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

$data = json_decode(file_get_contents('php://input'), true);

if($data['aksi']=='actualizarStatus'){
    $contrasena_usuario = md5($data['contrasena_usuario']);
    $query = mysqli_query($connection, "UPDATE tb_sacep_usuario SET 
        contrasena_usuario='$contrasena_usuario' WHERE correo_electronico_usuario='$data[correo_electronico_usuario]'");
}
if($query){
    $result = json_encode(array('success'=>true, 'result'=>'success'));
} else {
    $result = json_encode(array('success'=>false, 'result'=>'error'));
}
echo $result;

?>