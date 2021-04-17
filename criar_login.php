<?php
include 'includes/header.php';
?>

<div class="row">
    <div class="col s12 m6 push-m3 ">
        <h3 class="light">Cadastro Usuário</h3>
        <form action="create_login.php" method="post" enctype="multipart/form-data">
            <div class="input-field col s12">
                <input type="text" name="nome" id="nome">
                <label for="nome">Nome</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="usuario" id="usuario">
                <label for="usuario">Ususário</label>
            </div>
            <div class="input-field col s12">
                <input type="password" name="senha1" id="senha1">
                <label for="senha1">Senha</label>
            </div>
            <div class="input-field col s12">
                <input type="password" name="senha2" id="senha2">
                <label for="senha2">Confirmar Senha</label>
            </div>
            <div class="input-field col s12">
                Selecionar Arquivo: <input type="file" id="avatar" name="avatar">
            </div>
            <button type="submit" name="btn-criar-usuario" class="btn">Criar Usuário</button>
            <a href="index.php" class="btn green">Voltar</a>

        </form>
    </div>
</div>



<?php
include_once 'includes/footer.php';
?>
