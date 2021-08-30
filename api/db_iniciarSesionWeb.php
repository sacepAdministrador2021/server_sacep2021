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

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $correo_administrador = (isset($_GET['correo_administrador']) ? $_GET['correo_administrador']: '');
    $contrasena_administrador = md5(isset($_GET['contrasena_administrador']) ? $_GET['contrasena_administrador']: '');

    $sql = "Select * from tb_sacep_administradores where correo_administrador LIKE '".$correo_administrador."' and contrasena_administrador LIKE '".$contrasena_administrador."'";

    $result = mysqli_query($connection, $sql);
    $response = array();

    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_row($result);
        $id_administradores    = $row[0];
        $nombre_administrador = $row[1];
        $apellido_materno_administrador = $row[2];
        $apellido_paterno_administrador = $row[3];
        $genero_administrador = $row[4];
        $correo_administrador = $row[13];
        $id_rol = $row[10];
        $id_status = $row[11];
        $foto_administrador = $row[9];
        $color_status = $row[15];
        $code = "Bienvenido";
        $response = ['id_administradores' => $id_administradores, 'nombre_administrador' => $nombre_administrador, 'apellido_materno_administrador' => $apellido_materno_administrador, 'apellido_paterno_administrador' => $apellido_paterno_administrador, 'genero_administrador' => $genero_administrador, 'correo_administrador' => $correo_administrador, 'id_rol' => $id_rol, 'id_status' => $id_status, 'foto_administrador' => $foto_administrador, 'color_status' => $color_status]; 
        if ($id_status == "3"){
            $code3 = "¡Su cuenta ha sido bloqueada por incumplimiento a terminos y condiciones!";
            echo json_encode($code3);
        } else if ($id_status == "4"){
            echo json_encode($response);
        }
    } else {
        $code = "¡Correo electronico o contraseña incorrectos!";
        echo json_encode($code);
    }
}
?>