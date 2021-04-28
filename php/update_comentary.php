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




if(isset($_POST['btn-editar'])){
    $id = mysqli_escape_string(db_connect(), $_POST['id']);
    $post = mysqli_escape_string(db_connect(), $_POST['post']);
    $nome = mysqli_escape_string(db_connect(), $_POST['nome']);
    $nome_comparative = $dados['name'];
    
    if($nome_comparative != $nome):
         echo 'Você não pode editar comentários de outros usuários';
        echo '<button><a href="../home.php" class="btn green">Voltar</a></button>';
        echo '<button><a href="../index.php" class="btn green">Inicio</a></button>';
    elseif($name == 'Anônimo'):
        echo 'Esse Usuário não pode editar comentário';
        echo '<button><a href="../home.php" class="btn green">Voltar</a></button>';
        echo '<button><a href="../index.php" class="btn green">Inicio</a></button>';
    else:
        $sql = "update post set post = '$post', post_data = NOW() where id = '$id'";
    
        if(mysqli_query(db_connect(), $sql)){
        
            header('Location: ../home.php');
        }
        else{
            echo 'ERRO!';
            echo '<button><a href="../home.php" class="btn green">Voltar</a></button>';
            echo '<button><a href="../index.php" class="btn green">Inicio</a></button>';;
        }
    endif;
}
