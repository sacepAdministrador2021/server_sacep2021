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

    $correo_operador = (isset($_GET['correo_operador']) ? $_GET['correo_operador']: '');
    $contrasena_operador = md5(isset($_GET['contrasena_operador']) ? $_GET['contrasena_operador']: '');

    $sql = "Select * from tb_sacep_operadores where correo_operador LIKE '".$correo_operador."' and contrasena_operador LIKE '".$contrasena_operador."'";

    $result = mysqli_query($connection, $sql);
    $response = array();

    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_row($result);
        $id_operador_sacep    = $row[0];
        $num_empleado = $row[1];
        $nombre_operador = $row[2];
        $apellido_materno_operador = $row[3];
        $apellido_paterno_operador = $row[4];
        $genero_operador = $row[5];
        $correo_operador = $row[14];
        $id_rol = $row[11];
        $id_status = $row[12];
        $foto_operador = $row[10];
        $color_status = $row[16];
        $code = "Bienvenido";
        $response = ['id_operador_sacep' => $id_operador_sacep, 'num_empleado' => $num_empleado, 'nombre_operador' => $nombre_operador, 'apellido_materno_operador' => $apellido_materno_operador, 'apellido_paterno_operador' => $apellido_paterno_operador, 'genero_operador' => $genero_operador, 'correo_operador' => $correo_operador, 'id_rol' => $id_rol, 'id_status' => $id_status, 'foto_operador' => $foto_operador, 'color_status' => $color_status]; 
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