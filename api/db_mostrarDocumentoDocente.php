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

if ($postjson['sacep'] == "sacepMD"){
    $data = array();
    $query = mysqli_query($connection, "SELECT
    tb_sacep_documentacion_docente.*
FROM
    tb_sacep_documentacion_docente
WHERE
    tb_sacep_documentacion_docente.id_documentacion = '$postjson[id_documentacion]' AND tb_sacep_documentacion_docente.id_usuario = '$postjson[id_usuario]'");
   while($row = mysqli_fetch_array($query)){
        $data[] = array(
            'id_doc_docente' => $row['id_doc_docente'],
            'id_documentacion' => $row['id_documentacion'],
            'archivo_documento' => $row['archivo_documento'],
            'id_usuario' => $row['id_usuario']
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