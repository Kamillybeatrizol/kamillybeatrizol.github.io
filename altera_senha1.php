<?php
include_once ("conexao.php");
include ('verifica_login.php');


if (isset($_SESSION['senha_alterada'])) {
    echo $_SESSION['senha_alterada'];
    unset ($_SESSION['senha_alterada']);
};

if (isset($_SESSION['Digite'])) {
    echo $_SESSION['Digite'];
    unset ($_SESSION['Digite']);
};

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="cadas.css">
    <title></title>
</head>
<body>
<div class="formu">
    <h1>Alterar Senha</h1>
<form method="post" action="altera_senha2.php" enctype="multipart/form-data">
   <br> Digite sua senha: <input type="password" name="senha">
    <input type="submit" value="Confirmar">
</form>
    <button style=" background-color: #CFCFCF; border-radius: 6px" ><a href="Index_user.php">Voltar</a></button>


</body>
</html>