<?php
require 'db_connect.php';
include 'includes/header.php';

session_start();
if(!isset($_SESSION['logado'])):
header("Location: index.php");
else:
$id = $_SESSION['id_usuario'];
$sql = "select * from usuarios where id = '$id'";
$resultado = mysqli_query($connect,$sql);
$dados = mysqli_fetch_array($resultado);


endif;
//select
if(isset($_GET['id'])){
    $id = mysqli_escape_string($connect, $_GET['id']);
    $sql = "select * from post where id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);
}
?>

<div class="row">
    <div class="col s12 m6 push-m3 ">
        <h3 class="light">Editar Comentário</h3>
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $dados['id']; ?>" />
            <div class="input-field col s12">
                <input type="text" name="nome" id="nome" readonly="true" value="<?php echo $dados['post_nome']; ?>">
                <label for="nome">Nome</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="post_data" id="post_data" readonly="true" value="<?php echo $dados['post_data']; ?>">
                <label for="post_data">Data Da Postagem</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="post" id="post" value="<?php echo $dados['post']; ?>">
                <label for="post">Comentário</label>
            </div>
            <button type="submit" name="btn-editar" class="btn">Atualizar</button>
            <a href="home.php" class="btn green">Listar Comentários</a>
        </form>


    </div>

</div>



<?php
include_once 'includes/footer.php';
?>
