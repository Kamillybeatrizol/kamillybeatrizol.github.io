<?php
include_once ("conexao.php");

include ('verifica_login.php');

if(empty($_POST['senha'])){
    $_SESSION['Digite'] = 'Digite sua senha.';
    header('Location: altera_senha1.php');
    exit();
};


$usuario = $_SESSION['usuario'];

$senha = mysqli_real_escape_string($conn, $_POST['senha']);

$query = "SELECT id_usuario, login FROM usuarios WHERE login = '$usuario' and senha = '$senha'";

$executa = mysqli_query($conn, $query);

$linha = mysqli_num_rows($executa);

if ($linha == 1){
    $_SESSION['altera_senha'] = true;
    header('Location: altera_senha3.php');
    exit(); // Fechar os cabeçalhos.
}else{
    $_SESSION['altera_senha'] = false;
    header('Location: altera_senha1.php');
    exit();
}

