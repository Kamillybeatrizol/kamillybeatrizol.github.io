<?php
include ('verifica_login.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="./projeto/translateelement.css">
    <link rel="stylesheet" type="text/css" href="cadas.css">
    <title></title>
</head>

<body style="background-color: #90EE90">

<div style="font-size: 50px"><center>NOTICIÁRIO INSTITUCIONAL</center>
</div><br>
<button style=" background-color: #CFCFCF; border-radius: 6px" ><a href="Index_user.php">Voltar</a></button>
<button style=" background-color: #CFCFCF; border-radius: 6px" ><a href="logout.php">Sair</a></button>

<div class="bv">
    <br><br>

    <?php

    if (isset($_SESSION['aviso'])) {

        if ($_SESSION['aviso'] === 1) {
            echo "<p>Operação realizada com sucesso.</p>";
        } elseif ($_SESSION['aviso'] === 2) {
            echo "<p>Erro na operação</p>";
        } elseif ($_SESSION['aviso'] === 3) {
            echo "<p>Erro na operação. Título selecionado já está em uso.</p>";
        } elseif ($_SESSION['aviso'] === 4) {
            echo "<p>Preencha todos os campos.</p>";
        }
        $_SESSION['aviso'] = 0;
    }
    ?>

</div>


<?php

include_once ("conexao.php");

$pag_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);

$pagina = (!empty($pag_atual)) ? $pag_atual : 1;

$quant_itens_pg = 10;

$inicio = ($quant_itens_pg * $pagina) - $quant_itens_pg;

// Encontrar o ID do usuário atual

$usuario = $_SESSION['usuario'];
$query_u = "SELECT * FROM usuarios where login = '$usuario'";
$executar_u = mysqli_query($conn, $query_u);


$id_user;

while ($row_user = mysqli_fetch_assoc($executar_u)){
    $id_user = $row_user['id_usuario'];
};

$query = "SELECT * FROM noticias where id_usuario = $id_user LIMIT $inicio, $quant_itens_pg;";
$executar = mysqli_query($conn, $query);



while ($row_user = mysqli_fetch_assoc($executar)){

    // TITULO
    $id_not = $row_user['id_noticia'];
    echo $row_user['titulo'].'<br>';

    // IMAGEM
    $query3 = "SELECT * FROM imagens WHERE id_noticia = $id_not;";

    $executar3 = mysqli_query($conn, $query3);

    while ($row_user = mysqli_fetch_assoc($executar3)){

        $img = $row_user['caminho'];
        $alt = $row_user['legenda'];
        $caminho = 'imagens/'.$img;
        echo "<div><img src='$caminho' alt='$alt' width=\"700\" height=\"850\" /></div>";
    };
    echo "<button style=\" background-color: #A9A9A9; border-radius: 6px\" ><a href='editar.php?id=". $id_not. "'> Editar </a><br></button>";
    echo "<button style=\" background-color: #A9A9A9; border-radius: 6px\" ><a href='deletar.php?id=".$id_not."' onClick=\"javascript:return confirm('Tem certeza que deseja apagar notícia?');\">Apagar notícia</a><br></button>";



};

$query = "SELECT * FROM noticias where id_usuario = $id_user;";
$executar = mysqli_query($conn, $query);
$total_resultados = mysqli_num_rows($executar);


//Quantidade de páginas
$qauntidade_pag = ceil($total_resultados / $quant_itens_pg);

//Limitar a quantidade de links antes e depois
$max_links = 2;

echo "<button style=\" background-color: #A9A9A9; border-radius: 6px\" ><a href='listagem.php?pagina=1'>Primeira </a></button>";

for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
    if ($pag_ant > 0 and $pag_ant != 1)
    {echo "<a href='listagem.php?pagina=$pag_ant'> $pag_ant </a>";}
};

echo "<b> $pagina </b>";

for ($pag_pos = $pagina + 1; $pag_pos <= $pagina + $max_links; $pag_pos++){
    if ($pag_pos < $qauntidade_pag){
        echo "<a href='listagem.php?pagina=$pag_pos'> $pag_pos </a>";
    }
};

echo "<button style=\" background-color: #A9A9A9; border-radius: 6px\" ><a href='listagem.php?pagina=$qauntidade_pag'> Última</a></button>";

?>





</body>
</html>

