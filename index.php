<?php
//conexão
require 'db_connect.php';
//header
include'includes/header.php';
//sessão
session_start();

//botão enviar
    if(isset($_POST['btn-entrar'])):
        $erros = array();
        $login = mysqli_real_escape_string($connect, $_POST['login']);
        $senha = mysqli_real_escape_string($connect, $_POST['senha']);
        
        if(empty($login) or empty($senha)):
            $erros[] = "<li> Usuário ou senha inválido</li>";
        else:
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
        endif;
    endif;
       
        ?>
<div class="container">
    <div class="col s12 m6 push-m3 ">
        <h3 class="light">Login</h3>
        <?php 
        if(!empty($erros)):
            foreach($erros as $erro):
    echo $erro;
        endforeach;
    endif; 
        
        
    ?>
        <hr>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            Login: <input type="text" name="login"><br>
            Senha: <input type="password" name="senha"><br>
            <button type="submit" class="btn" name="btn-entrar">Entrar</button>
            <a class="btn" href="anonimo.php">Modo Anônimo</a>
            <a class="btn waves-effect waves-light" href="criar_login.php">Criar Login</a>

        </form>
    </div>
</div>

<?php 
    include'includes/footer.php';
?>
