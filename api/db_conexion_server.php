<?php 
define('HOST', 'localhost');
define('USER', 'cqcfdekv_sacep_aw2021Administrador');
define('PASS', '!Ep7HOmx((2}');
define('DB', 'cqcfdekv_sacep_aw2021');

$connection = mysqli_connect(HOST, USER, PASS, DB);

if(!$connection) {
     die ("Error en la conexión con el servidor" .mysqli_connect_error());
}
?>
