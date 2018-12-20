<?php session_start();?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="cadas.css">
    <title>Fazer Login </title>
</head>

<script type="text/javascript">
    var input = document.querySelector('#input input');
</script>

<body>
<div class="bv">
<?php
if(isset($_SESSION['nao_autenticado'])): ?>
    <p>ERRO: Usuário ou senha inválidos.</p>
<?php
endif; // substitui as chaves do if acima.
unset($_SESSION['nao_autenticado']);
?>
</div>
<div class="formu">
    <h1>Login</h1>
    <form action="login.php" method="POST">
        <input name="usuario" type="text" placeholder="Usuário"><br>
        <input name="senha" type="password" placeholder="Senha" ><br>
        <input type="submit" name="Entrar" />
    </form>
</form>
</div>

</body>

</html>



