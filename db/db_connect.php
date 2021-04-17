<?php
//conexão com o banco de dados
$servername = "crud.cevra8d9w8qt.us-east-1.rds.amazonaws.com";
$username = "root";
$password = "Passw0rd";
$database = "rds_aws";

$connect = mysqli_connect($servername, $username, $password, $database);
mysqli_set_charset($connect, "utf8");
if(mysqli_connect_error()){
    echo "Erro de conexão: " .mysqli_connect_error();
}
