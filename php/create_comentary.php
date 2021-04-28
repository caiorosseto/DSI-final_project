<?php
require '../db/db_connect.php';
session_start();

if(!isset($_SESSION['logado'])):
    header("Location: ../index.php"); 
else:
    $id = $_SESSION['id_usuario'];
    $sql = "select * from usuarios where id = '$id'";
    $resultado = mysqli_query(db_connect(),$sql);
    $dados = mysqli_fetch_array($resultado);


endif;

$id_usuario = $dados['id'];

if(isset($_POST['btn-enviar'])):
    $post = mysqli_escape_string(db_connect(), $_POST['comentario']);
    $nome = $dados['name'];
    $sql = "insert into post (id_usuario, post, post_nome, post_data) values ('$id_usuario','$post', '$nome', NOW())";
    if(mysqli_query(db_connect(), $sql)):
        header('Location: ../home.php');
    else:
        echo 'ERRO!';
        echo '<button><a href="../home.php" class="btn green">Voltar</a></button>';
        echo '<button><a href="../index.php" class="btn green">Inicio</a></button>';
    endif;

endif;
