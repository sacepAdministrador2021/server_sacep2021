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

    $correo_electronico_usuario = (isset($_GET['correo_electronico_usuario']) ? $_GET['correo_electronico_usuario']: '');
    $contrasena_usuario = md5(isset($_GET['contrasena_usuario']) ? $_GET['contrasena_usuario']: '');

    $sql = "Select * from tb_sacep_usuario where correo_electronico_usuario LIKE '".$correo_electronico_usuario."' and contrasena_usuario LIKE '".$contrasena_usuario."'";

    $result = mysqli_query($connection, $sql);
    $response = array();

    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_row($result);
        $id_usuario    = $row[0];
        $nombre_usuario = $row[1];
        $apellido_materno_usuario = $row[2];
        $apellido_paterno_usuario = $row[3];
        $genero_usuario = $row[4];
        $correo_electronico_usuario = $row[8];
        $id_rol = $row[11];
        $id_status = $row[10];
        $foto_usuario = $row[15];
        $color_status = $row[16];
        $code = "Bienvenido";
        $response = ['id_usuario' => $id_usuario, 'nombre_usuario' => $nombre_usuario, 'apellido_materno_usuario' => $apellido_materno_usuario, 'apellido_paterno_usuario' => $apellido_paterno_usuario, 'genero_usuario' => $genero_usuario, 'correo_electronico_usuario' => $correo_electronico_usuario, 'id_rol' => $id_rol, 'id_status' => $id_status, 'foto_usuario' => $foto_usuario, 'color_status' => $color_status]; 
        if ($id_status == "3"){
            $code3 = "¡Su cuenta ha sido bloqueada por incumplimiento a terminos y condiciones!";
            echo json_encode($code3);
        } else if ($id_status == "4"){
            echo json_encode($response);
        } else if ($id_status == "5"){
            echo json_encode($response);
        } else if ($id_status == "6"){
            echo json_encode($response);
        } else if ($id_status == "7"){
            echo json_encode($response);
        } else if ($id_status == "8"){
            echo json_encode($response);
        }
    } else {
        $code = "¡Correo electronico o contraseña incorrectos!";
        echo json_encode($code);
    }
}
?>