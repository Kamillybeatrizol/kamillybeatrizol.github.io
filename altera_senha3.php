<?php
include_once ("conexao.php");
include ('verifica_login.php');


if(!$_SESSION['altera_senha']){
    header("Location: altera_senha1.php");
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
<form method="post" action="alterar.php" enctype="multipart/form-data">
    <br>Digite sua nova senha: <input type="password" name="senha">
    <input type="submit" value="Confirmar">
</form>


</body>
</html>

