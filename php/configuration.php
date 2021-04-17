<?php
/*
*
* Efetua conecão com o banco de dados
*
* @return $connect
*/

function db_connect(){
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
   return $connect; 
}

/*
*
* Cria o comentario no banco de dados na tabela post
*
* 
*/

function create_comentary(){
    //sessão
session_start();


if(!isset($_SESSION['logado'])):
    header("Location: index.php");
else:
    $id = $_SESSION['id_usuario'];
    $sql = "select * from usuarios where id = '$id'";
    $resultado = mysqli_query(db_connect(),$sql);
    $dados = mysqli_fetch_array($resultado);


endif;


if(isset($_POST['btn-enviar'])):
    $post = mysqli_escape_string(db_connect(), $_POST['comentario']);
    $nome = $dados['name'];
    $sql = "insert into post (post, post_nome, post_data) values ('$post', '$nome', NOW())";
    if(mysqli_query(db_connect() $sql)):
        header('Location: home.php');
    else:
        header('Location: logout.php');
    endif;

endif;
    
}

/*
*
* Cria o login do usuario no banco de dados
*
* 
*/

function create_login(){
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
    $diretorio = "img/";

    move_uploaded_file($_FILES['avatar']['tmp_name'], $diretorio . $photo);
        
    if($senha1 != $senha2):
        header('Location: index.php');
    else:
        $sql = "insert into usuarios (name, password, username, imagem) values ('$nome', '$senha1', '$usuario', '$photo')";

        if(mysqli_query(db_connect(), $sql)):
        header('Location: index.php');
        else:
        header('Location: criar_login.php');
        endif;
    endif;
endif;

}

/*
*
* Edita o comentário do usuário
*
* 
*/

function update_comentary(){
    //sessão
session_start();


if(!isset($_SESSION['logado'])):
    header("Location: index.php");
else:
    $id = $_SESSION['id_usuario'];
    $sql = "select * from usuarios where id = '$id'";
    $resultado = mysqli_query(db_connect(),$sql);
    $dados = mysqli_fetch_array($resultado);


endif;


if(isset($_POST['btn-editar'])){
    $id = mysqli_escape_string(db_connect(), $_POST['id']);
    $post = mysqli_escape_string(db_connect(), $_POST['post']);
    $id_comparative = $dados['id'];
    
    if($id_comparative != $id):
        header('Location: index.php');
    else:
        $sql = "update post set post = '$post', post_data = NOW() where id = '$id'";
    
        if(mysqli_query(db_connect(), $sql)){
        
            header('Location: home.php');
        }
        else{
            header('Location: index.php');
        }
    endif;
}

}

/*
*
* Deleta o comentário do usuário
*
* 
*/

function delete_comentary(){
        //sessão
session_start();


if(!isset($_SESSION['logado'])):
    header("Location: index.php");
else:
    $id = $_SESSION['id_usuario'];
    $sql = "select * from usuarios where id = '$id'";
    $resultado = mysqli_query(db_connect(),$sql);
    $dados = mysqli_fetch_array($resultado);


endif;
    

if(isset($_POST['btn-deletar'])){
    $id = mysqli_escape_string(db_connect(), $_POST['id']);
     $id_comparative = $dados['id'];
    
    if($id_comparative != $id):
        header('Location: index.php');
    else:
        
        $sql = "delete from post where id = '$id'";
    
        if(mysqli_query(db_connect(), $sql)){
        
            header('Location: home.php');
        }
        else{
            header('Location: index.php');
        }
    endif;
}
}

/*
*
* Encerra a sessão do usuário
*
* 
*/

function logout(){
//encerrando a sessão
session_start();
session_unset();
session_destroy();
header("Location: index.php");

}

/*
*
* Inicia a sessão fixa do usuário anonimo
*
* 
*/

function anonimo_login(){
session_start();

//botão enviar
    $login = 'anonimo';
    $senha = '123';
        
        
            $sql = "select id, username, password from usuarios where username = '$login' and password = '$senha'";
            $resultado = mysqli_query($connect,$sql);
            if(mysqli_num_rows($resultado) >0 ):
                $dados = mysqli_fetch_array($resultado);
                mysqli_close($connect);
                $_SESSION['logado'] = true;
                $_SESSION['id_usuario'] = $dados['id'];
                header('Location: home.php');
            else:
                $erros[] = "<li> Usuário ou senha inválido login</li>";
            endif;
}
