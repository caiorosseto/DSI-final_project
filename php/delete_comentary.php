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

if(isset($_POST['btn-deletar'])){
    $id = mysqli_escape_string(db_connect(), $_POST['id']);
    $name = mysqli_escape_string(db_connect(), $_POST['nome']);
     $name_comparative = $dados['name'];
    
    if($name_comparative != $name):
        echo 'Você só pode deletar o seu comentário';
        echo '<button><a href="../home.php" class="btn green">Voltar</a></button>';
        echo '<button><a href="../index.php" class="btn green">Inicio</a></button>';
    elseif($name == 'Anônimo'):
        echo 'Esse Usuário não pode deletar comentário';
        echo '<button><a href="../home.php" class="btn green">Voltar</a></button>';
        echo '<button><a href="../index.php" class="btn green">Inicio</a></button>';
    else:        
        $sql = "delete from post where id = '$id'";
    
        if(mysqli_query(db_connect(), $sql)){
        
            header('Location: ../home.php');
        }
        else{
            header('Location: ../index.php');
        }
    endif;
}
