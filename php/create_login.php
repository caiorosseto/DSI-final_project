<?php
require '../db/db_connect.php';

//sessão
session_start();

if(isset($_POST['btn-criar-usuario'])):
    $nome = mysqli_escape_string(db_connect(), $_POST['nome']);
    $usuario = mysqli_escape_string(db_connect(), $_POST['usuario']);
    $senha1 = mysqli_escape_string(db_connect(), $_POST['senha1']);
    $senha2 = mysqli_escape_string(db_connect(), $_POST['senha2']);
    $avatar = mysqli_escape_string(db_connect(), $_FILES['avatar']['name']);
    $extensao = strtolower(pathinfo($avatar, PATHINFO_EXTENSION));
    $photo = md5(time()).".".$extensao;
    $diretorio = "../img/";

    move_uploaded_file($_FILES['avatar']['tmp_name'], $diretorio . $photo);
        
    if($senha1 != $senha2):
        echo 'Senhas não conferem';
        echo '<button><a href="../home.php" class="btn green">Voltar</a></button>';
        echo '<button><a href="../index.php" class="btn green">Inicio</a></button>';
    else:
        $sql = "insert into usuarios (name, password, username, imagem) values ('$nome', '$senha1', '$usuario', '$photo')";

        if(mysqli_query(db_connect(), $sql)):
            echo 'Cadastrado com sucesso!';
            echo '<button><a href="../home.php" class="btn green">Voltar</a></button>';
            echo '<button><a href="../index.php" class="btn green">Inicio</a></button>'; 
        else:
            echo 'ERRO! <br>';
            echo '<button><a href="../home.php" class="btn green">Voltar</a></button>';
            echo '<button><a href="../index.php" class="btn green">Inicio</a></button>';      
        endif;
    endif;
endif;
