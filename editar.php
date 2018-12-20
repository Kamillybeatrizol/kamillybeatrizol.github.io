<?php
include_once ("conexao.php");
include ('verifica_login.php');

$id_not = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query = "SELECT * FROM noticias WHERE id_noticia = '$id_not'";
$executa = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($executa);

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <title></title>
</head>
<body>

<!--<div class="formu">-->

<h1>Editar Notícia</h1>
<form method="post" action="proc_editar1.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $row['id_noticia']; ?>">
    Título: <input type="text" name="titulo" value="<?php echo $row['titulo']; ?>"><br>
    Descrição: <input type="text" name="descricao" value="<?php echo $row['descricao']; ?>"><br>
    Data de expiração: <input type="date" name="data_expira" "><br>
    Novas imagens: <input type="file" name="image[]" multiple="multiple" placeholder="Conteúdo (em imagens)">
    <p>(Deixe em branco caso queira manter as imagens atuais)</p>
    <input type="submit" value="Editar">
</form>


</body>
</html>