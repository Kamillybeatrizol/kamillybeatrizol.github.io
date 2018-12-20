<?php
include ('verifica_login.php');
?>

<div class="bv">

    <?php

    if (isset($_SESSION['criado'])) {
        echo $_SESSION['criado'];
    }
    $_SESSION['criado'] = '';
    ?>

</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="cadas.css">
    <title>Cadastrar usuário</title>
</head>
<body>
<button style=" background-color: #CFCFCF; border-radius: 6px" ><a href="Index_user.php">Voltar</a></button>
<div class="formu">
    <h1> Cadastrar usuário </h1>
    <form method="post" action="ProCadastroUser.php">
        <input type="text" name="nome" placeholder="Nome do usuário"><br>
        <input type="password" name="senha" placeholder="Senha"><br>
        <input type="submit" name="Enviar" />
    </form>
</div>
</body>

</html>
