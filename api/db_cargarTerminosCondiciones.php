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

if ($postjson['sacepTC1'] == 'sacepD') {
    $data = array();
    $query = mysqli_query($connection, "SELECT * FROM tb_sacep_avisoprivacidad ORDER BY id_avisoPrivacidad DESC");

    while ($row = mysqli_fetch_array($query)) {

        $data = array(
            'titulo_avisoPrivacidad'   => $row['titulo_avisoPrivacidad'],
            'descripcion_general' => $row['descripcion_general']
        );
    }

    if ($query) {
        $result = json_encode(array('success' => true, 'result' => $data));}
    else{
        $result = json_encode(array('success' => false));}
    

    echo $result;
} 
else if ($postjson['sacepTC2'] == 'sacepDC') {
    $data = array();
    $query = mysqli_query($connection, "SELECT * FROM tb_sacep_avisoprivacidad ORDER BY id_avisoPrivacidad DESC");

    while ($row = mysqli_fetch_array($query)) {

        $data = array(
            'titulo_avisoPrivacidad'   => $row['titulo_avisoPrivacidad'],
            'descripcion_general' => $row['descripcion_general'],
            'parrafo_num1' => $row['parrafo_num1'],
            'parrafo_num2'    => $row['parrafo_num2'],
            'parrafo_num3'    => $row['parrafo_num3'],
            'parrafo_num4'    => $row['parrafo_num4'],
            'parrafo_num5'    => $row['parrafo_num5'],
            'parrafo_num6'    => $row['parrafo_num6'],
            'parrafo_num7'    => $row['parrafo_num7'],
            'parrafo_num8'    => $row['parrafo_num8'],
            'parrafo_num9'    => $row['parrafo_num9'],
            'parrafo_num10'    => $row['parrafo_num10'],
            'parrafo_num11'    => $row['parrafo_num11'],
            'parrafo_num12'    => $row['parrafo_num12'],
            'parrafo_num13'    => $row['parrafo_num13'],
            'parrafo_num14'    => $row['parrafo_num14'],
            'parrafo_num15'    => $row['parrafo_num15'],
            'parrafo_num16'    => $row['parrafo_num16'],
            'parrafo_num17'    => $row['parrafo_num17'],
            'parrafo_num18'    => $row['parrafo_num18'],
            'parrafo_num19'    => $row['parrafo_num19'],
            'parrafo_num20'    => $row['parrafo_num20'],
            'parrafo_num21'    => $row['parrafo_num21'],
            'parrafo_num22'    => $row['parrafo_num22'],
            'parrafo_num23'    => $row['parrafo_num23'],
            'parrafo_num24'    => $row['parrafo_num24'],
            'parrafo_num25'    => $row['parrafo_num25'],
            'parrafo_num26'    => $row['parrafo_num26'],
            'parrafo_num27'    => $row['parrafo_num27'],
            'parrafo_num28'    => $row['parrafo_num28'],
            'parrafo_num29'    => $row['parrafo_num29'],
            'parrafo_num30'    => $row['parrafo_num30'],
            'parrafo_num31'    => $row['parrafo_num31'],
            'parrafo_num32'    => $row['parrafo_num32'],
            'parrafo_num33'    => $row['parrafo_num33'],
            'parrafo_num34'    => $row['parrafo_num34'],
            'parrafo_num35'    => $row['parrafo_num35'],
            'parrafo_num36'    => $row['parrafo_num36'],
            'parrafo_num37'    => $row['parrafo_num37'],
            'parrafo_num38'    => $row['parrafo_num38'],
            'parrafo_num39'    => $row['parrafo_num39'],
            'parrafo_num40'    => $row['parrafo_num40'],
            'parrafo_num41'    => $row['parrafo_num41'],
            'parrafo_num42'    => $row['parrafo_num42'],
            'parrafo_num43'    => $row['parrafo_num43'],
            'parrafo_num44'    => $row['parrafo_num44'],
            'parrafo_num45'    => $row['parrafo_num45'],
            'parrafo_num46'    => $row['parrafo_num46'],
            'parrafo_num47'    => $row['parrafo_num47'],
            'parrafo_num48'    => $row['parrafo_num48'],
            'parrafo_num49'    => $row['parrafo_num49'],
            'parrafo_num50'    => $row['parrafo_num50'],
            'parrafo_num51'    => $row['parrafo_num51'],
            'parrafo_num52'    => $row['parrafo_num52'],
            'parrafo_num53'    => $row['parrafo_num53'],
            'parrafo_num54'    => $row['parrafo_num54'],
            'parrafo_num55'    => $row['parrafo_num55'],
            'parrafo_num56'    => $row['parrafo_num56'],
            'parrafo_num57'    => $row['parrafo_num57'],
            'parrafo_num58'    => $row['parrafo_num58'],
            'parrafo_num59'    => $row['parrafo_num59'],
            'parrafo_num60'    => $row['parrafo_num60'],
            'parrafo_num61'    => $row['parrafo_num61'],
            'parrafo_num62'    => $row['parrafo_num62'],
            'parrafo_num63'    => $row['parrafo_num63'],
            'parrafo_num64'    => $row['parrafo_num64'],
            'parrafo_num65'    => $row['parrafo_num65'],
            'parrafo_num66'    => $row['parrafo_num66'],
            'parrafo_num67'    => $row['parrafo_num67'],
            'parrafo_num68'    => $row['parrafo_num68'],
            'parrafo_num69'    => $row['parrafo_num69'],
            'parrafo_num70'    => $row['parrafo_num70'],
            'parrafo_num71'    => $row['parrafo_num71'],
            'parrafo_num72'    => $row['parrafo_num72'],
            'parrafo_num73'    => $row['parrafo_num73'],
            'parrafo_num74'    => $row['parrafo_num74'],
            'parrafo_num75'    => $row['parrafo_num75'],
            'parrafo_num76'    => $row['parrafo_num76'],
            'parrafo_num77'    => $row['parrafo_num77'],
            'parrafo_num78'    => $row['parrafo_num78'],
            'parrafo_num79'    => $row['parrafo_num79'],
            'parrafo_num80'    => $row['parrafo_num80'],
            'parrafo_num81'    => $row['parrafo_num81'],
            'parrafo_num82'    => $row['parrafo_num82'],
            'parrafo_num83'    => $row['parrafo_num83'],
            'parrafo_num84'    => $row['parrafo_num84'],
            'parrafo_num85'    => $row['parrafo_num85'],
            'parrafo_num86'    => $row['parrafo_num86'],
            'parrafo_num87'    => $row['parrafo_num87'],
            'parrafo_num88'    => $row['parrafo_num88'],
            'parrafo_num89'    => $row['parrafo_num89'],
            'parrafo_num90'    => $row['parrafo_num90'],
            'parrafo_num91'    => $row['parrafo_num91'],
            'parrafo_num92'    => $row['parrafo_num92'],
        );
    }

    if ($query) {
        $result = json_encode(array('success' => true, 'result' => $data));}
    else{
        $result = json_encode(array('success' => false));}
    

    echo $result;
}