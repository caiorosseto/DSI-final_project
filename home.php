<?php
//conexão
require './db/db_connect.php';
//header
include'includes/header.php';
//sessão
session_start();

if(!isset($_SESSION['logado'])):
    header("Location: ../index.php");
else:
    $id = $_SESSION['id_usuario'];
    $sql = "select * from usuarios where id = '$id'";
    $resultado = mysqli_query(db_connect(),$sql);
    $dados = mysqli_fetch_array($resultado);


endif;


?>

<div class="container">

    <div class="row">
        <div class="col s12 m6 push-m3 ">
            <h1>Bem-Vindo <?php echo $dados['name']; ?></h1>
            <h3 class="light">Comentários</h3>
            <div class="row">
                <form action="./php/create_comentary.php" method="post" class="col s12">
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea name="comentario" id="comentario" class="materialize-textarea"></textarea>
                            <label for="textarea1">Digite seu comentário</label>
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light" type="submit" name="btn-enviar">Enviar<i class="material-icons right">send</i></button>
                </form>
            </div>
            <br>
            <?php
                    $sql = "SELECT p.id, p.post, p.post_nome, p.post_data, u.imagem from post p inner join usuarios u on p.id_usuario = u.id ORDER BY id DESC";
                    $resultado = mysqli_query(db_connect(),$sql);
                    mysqli_close(db_connect());
                    if(mysqli_num_rows($resultado) > 0):
                        
                    while($dados = mysqli_fetch_array($resultado)):
                ?>
            <ul class="collection">
                <li class="collection-item avatar">
                    <img src="./img/<?php echo $dados['imagem']; ?>" alt="" class="circle">
                    <span class="title"><?php echo $dados['post_nome']; ?></span>
                    <p><?php echo $dados['post_data']; ?> <br>
                        <?php echo $dados['post']; ?> <br>
                        <a href="./editar_comentario?id=<?php echo $dados['id']; ?>" class="tertiary-content"><i class="material-icons">edit</i>Atualizar <a href="deletar_comentario.php?id=<?php echo $dados['id']; ?>" class="tertiary-content"><i class="material-icons">delete</i>Deletar</a></a>

                    </p>
                </li>
            </ul>
            <?php 
                endwhile;
                endif; 
            ?>
        </div>
    </div>
    <a class="btn waves-effect waves-light" href="./php/logout.php">Sair</a>
    <a class="btn waves-effect waves-light" href="criar_login.php">Criar Login</a>

</div>



<?php 
    include'includes/footer.php';
?>
