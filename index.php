<?php
//conexão
require './db/db_connect.php';
//header
include'includes/header.php';
//sessão
session_start();

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
        <form action="./php/login.php" method="post">
            Login: <input type="text" name="login"><br>
            Senha: <input type="password" name="senha"><br>
            <button type="submit" class="btn" name="btn-entrar">Entrar</button>
            <a class="btn" href="php/anonimo.php">Modo Anônimo</a>
            <a class="btn waves-effect waves-light" href="criar_login.php">Criar Login</a>

        </form>
    </div>
</div>

<?php 
    include'includes/footer.php';
?>
