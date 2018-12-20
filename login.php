<?php
session_start();
include('conexao.php');

if(empty ($_POST['usuario']) || empty($_POST['senha'])){
    header('Location: index.php');
    exit();
}

$usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
$senha = mysqli_real_escape_string($conn, $_POST['senha']);

$query = "SELECT id_usuario, login FROM usuarios WHERE login = '$usuario' and senha = '$senha'";

$executa = mysqli_query($conn, $query);

$linha = mysqli_num_rows($executa);

if ($linha == 1){
    $_SESSION['usuario'] = $usuario;
    header('Location: Index_user.php');
    exit(); // Fechar os cabeçalhos.
}else{
    $_SESSION['nao_autenticado'] = true;
    header('Location: loginform.php');
    exit();
}


