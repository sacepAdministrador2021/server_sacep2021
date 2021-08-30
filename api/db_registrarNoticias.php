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

if($data['aksi']=='imageNoticia'){
    $keyunique = date('YmdHis');
    $entry = base64_decode($data['imagen_noticia']);
    $img = imagecreatefromstring($entry);
    $directory = "../images/noticias/img_".$keyunique.".jpeg";
    imagejpeg($img, $directory);
    imagedestroy($img);
    $query = mysqli_query($connection, "INSERT INTO tb_sacep_noticias SET
        titulo_noticias='$data[titulo_noticias]',
        resumen_noticias='$data[resumen_noticias]',
        texto_noticia='$data[texto_noticia]',
        url_noticia='$data[url_noticia]',
        imagen_noticia='$directory'");
}
if($query){
    $result = json_encode(array('success'=>true, 'result'=>'success'));
} else {
    $result = json_encode(array('success'=>false, 'result'=>'error'));
}
echo $result;
?>