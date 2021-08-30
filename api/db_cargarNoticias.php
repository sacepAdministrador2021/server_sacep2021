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

if ($postjson['sacepPs'] == 'sacepNoticia') {
    $data = array();
    $query = mysqli_query($connection, "SELECT * FROM `tb_sacep_noticias` order by tb_sacep_noticias.id_noticias DESC");

    while ($row = mysqli_fetch_array($query)) {

        $data[] = array(
            'id_noticias'   => $row['id_noticias'],
            'titulo_noticias' => $row['titulo_noticias'],
            'resumen_noticias' => $row['resumen_noticias'],
            'texto_noticia' => $row['texto_noticia'],
            'url_noticia' => $row['url_noticia'],
            'imagen_noticia' => $row['imagen_noticia']
        );
    }

    if ($query) {
        $result = json_encode(array('success' => true, 'result' => $data));}
    else{
        $result = json_encode(array('success' => false));}
    

    echo $result;
}