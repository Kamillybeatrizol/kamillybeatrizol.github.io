<?php
include_once ("conexao.php");
include ('verifica_login.php');

if ($_SESSION['altera_senha'] === true){

    $usuario = $_SESSION['usuario'];
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    $query = "UPDATE usuarios SET senha='$senha' WHERE login='$usuario'";
    $executar = mysqli_query($conn, $query);

    if(mysqli_affected_rows($conn)){
        $_SESSION['senha_alterada'] = 'Senha alterada com sucessso';
        header('Location: altera_senha1.php');
    } else {
        $_SESSION['senha_alterada'] = 'Falha ao alterar senha. Tente novamente.';
        header('Location: altera_senha1.php');
    };

};


