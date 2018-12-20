<?php
include ('verifica_login.php');
include_once ("conexao.php");

session_start();
$_SESSION['aviso'] = 0;

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query = "SELECT * FROM imagens WHERE id_noticia =$id";
$executar = mysqli_query($conn, $query);

while ($row_user = mysqli_fetch_assoc($executar)){
    $id_img = $row_user['id_imagem'];
    $img = $row_user['caminho'];
    $caminho = 'imagens/'.$img;
    unlink($caminho);
    $query1 = "DELETE FROM imagens WHERE id_imagem = $id_img";
    $executar1 = mysqli_query($conn, $query1);
};

$query2 = "DELETE FROM noticias WHERE id_noticia=$id";
$executar2 = mysqli_query($conn, $query2);

if(mysqli_affected_rows($conn)){
    header("Location: listagem.php");
    $_SESSION['aviso'] = 1;
}else{
    header("Location: listagem.php");
    $_SESSION['aviso'] = 2;
};




/**

$img = $row_user['caminho'];
$caminho = 'imagens/'.$img;


// Se faz necessário que as iamgens sejam salvas com o nome de seu id no banco

$delcheck = mysqli_query("DELETE FROM imagens WHERE id_noticia = '$id'") or die (mysqli_error());
unlink($pasta_imgs.'/'.$logo);

$query1 = "DELETE FROM notícias WHERE id='$id'";
$executar1 = mysqli_query($conn, $query1);

if(mysqli_affected_rows($conn)){
    header("Location: Index.php");
}else{
    header("Location: Index.php");
} **/
