<?php
require '../db/db_connect.php';
session_start();
//botão enviar
    if(isset($_POST['btn-entrar'])):
        $erros = array();
        $login = mysqli_real_escape_string(db_connect(), $_POST['login']);
        $senha = mysqli_real_escape_string(db_connect(), $_POST['senha']);
        
        if(empty($login) or empty($senha)):
            $erros[] = "<li> Usuário ou senha inválido</li>";
        else:
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
        endif;
    endif;
       
