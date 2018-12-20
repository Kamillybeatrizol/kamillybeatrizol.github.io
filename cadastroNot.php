<?php
include ('verifica_login.php');
?>

<div class="bv">

    <?php

    if (isset($_SESSION['criada'])) {

        if ($_SESSION['criada'] === 1) {
            echo "<p>Notícia criada com sucesso.</p>";
        } elseif ($_SESSION['criada'] === 2) {
            echo "<p>Erro ao criar notícia. Título já existe, insira um diferente</p>";
        } elseif ($_SESSION['criada'] === 3) {
            echo "<p>Erro ao criar notícia.</p>";
        } elseif ($_SESSION['criada'] === 4) {
            echo "<p>Erro ao criar notícia. Falha no envio de arquivos. Tente novamente.</p>";
        }
        $_SESSION['criada'] = 0;
    }
    ?>

</div>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="cadas.css">
    <title></title>
</head>
<body>

<button style=" background-color: #CFCFCF; border-radius: 6px" ><a href="Index_user.php">Voltar</a></button>
<div class="formu">
<h1>Cadastro de Notícias</h1>

<form method="post" action="TESTE.php" enctype="multipart/form-data">
    <input type="text" name="titulo" placeholder="Título"><br>
    <input type="text" name="descricao" placeholder="Descrição"><br>
    <input type="number" name="duracao" placeholder="Duração (em dias)"><br>
    <input type="file" name="image[]" multiple="multiple" placeholder="Conteúdo (em imagens)">
    <input type="submit" value="Cadastrar">
</form>
</div>

<center>
    <div class="formu">
        <h3> Nosso noticiário só aceita PDF em IMG, para converter click <a href="https://www.ilovepdf.com/pt/pdf_para_jpg"> aqui</a> </h3>
    </div>

</center>

</body>
</html>



