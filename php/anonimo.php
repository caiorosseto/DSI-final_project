<?php
require '../db/db_connect.php';
session_start();


$login = 'anonimo';
$senha = '123';


$sql = "select id, username, password from usuarios where username = '$login' and password = '$senha'";
$resultado = mysqli_query(db_connect(),$sql);
if(mysqli_num_rows($resultado) >0 ):
$dados = mysqli_fetch_array($resultado);
mysqli_close(db_connect());
$_SESSION['logado'] = true;
$_SESSION['id_usuario'] = $dados['id'];
header('Location: ../home.php');
else:
$erros[] = "<li> Usuário ou senha inválido login</li>";
endif;


 
