<?php
include ('verifica_login.php');
include ('conexao.php');

// Encontrar o ID do usuário atual


$usuario = $_SESSION['usuario'];

//echo "Usuário: ".$usuario;

$query_u = "SELECT * FROM usuarios where login = '$usuario'";
$executar_u = mysqli_query($conn, $query_u);

// procurar id pelo nome do usuario

$id_user;

while ($row_user = mysqli_fetch_assoc($executar_u)){
    $id_user = $row_user['id_usuario'];
};

$query = "DELETE FROM usuarios WHERE id_usuario='$id_user'";
$executar = mysqli_query($conn, $query);

if(mysqli_affected_rows($conn)){
    header("Location: Index.php");
    $_SESSION['aviso'] = 1;
}else{
    header("Location: Index.php");
    $_SESSION['aviso'] = 2;
};


