<?php

include_once ("conexao.php");
include ('verifica_login.php');

$_SESSION['criada'] = 0;

// Recuperando os dados enviados pelo  usuário

// Conferindo se o título já existe no banco

$titulo = filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_STRING);

$query = "SELECT * FROM noticias";
$executar = mysqli_query($conn, $query);

$existe = false;

while ($row_user = mysqli_fetch_assoc($executar)){
    if ($row_user['titulo'] == $titulo){
        $existe = true;
    }
};


if ($existe == false){

    $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_STRING);
    $duracao = filter_input(INPUT_POST, "duracao", FILTER_SANITIZE_NUMBER_INT);


// Configurando a data de expiração

    $dt = new DateTime();

    $dt->add (new DateInterval("P".$duracao."D"));


    function converter($d) {
        return $d->format( "Y-m-d" ); }
    $d = converter($dt);

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


    $query1 = "INSERT INTO noticias (id_usuario, titulo, descricao, data_postagem, data_expiracao) VALUES ('$id_user', '$titulo','$descricao', NOW(), '$d')";
    $executar1 = mysqli_query($conn, $query1);

    // Verificando se os dados foram inseridos corretamente na tabela

    if (mysqli_insert_id($conn)){
        $_SESSION['criada'] = 1;
    }else{
        $_SESSION['criada'] = 3;
        header("Location: cadastroNot.php");
    };

} else {
    $_SESSION['criada'] = 2;
    header("Location: cadastroNot.php");
}


// Salvando as imagens e guardando informações na tabela "imagens"

$query2 = "SELECT * FROM noticias where titulo = '$titulo'";
$executar2 = mysqli_query($conn, $query2);

$id_not;

while ($row_user = mysqli_fetch_assoc($executar2)){
    $id_not = $row_user['id_noticia'];
}


#Selecionar maior id da tabela de imagens

$query_max = "SELECT MAX(id_imagem) AS MAXID FROM imagens";
$result = mysqli_query($conn, $query_max);
$row = mysqli_fetch_array($result);

$mid = $row["MAXID"];


#Analisa cada arquivo

$i = 0;
$n = 1;

if(isset($_FILES['image'])){

    foreach ($_FILES["image"]["error"] as $key => $error) {
        $extensao = strtolower(substr($_FILES['image']['name'][$i], -4));
        $nome = $mid + $n;
        $novo_nome =  (string)$nome.$extensao;

        # Definir o diretório onde salvar os arquivos.
        $destino = utf8_decode ("imagens/" . $novo_nome);

        #Move o arquivo para o diretório de destino
        move_uploaded_file( $_FILES["image"]["tmp_name"][$i], $destino );

        #Próximo arquivo a ser analisado

        $query2 = "INSERT INTO imagens (id_noticia, caminho, legenda) VALUES ('$id_not', '$novo_nome', '$descricao')";
        $executar2 = mysqli_query($conn, $query2);

        if(mysqli_affected_rows($conn)){
            header("Location: cadastroNot.php");
        }else{
            $query3 = "DELETE FROM noticias WHERE id_noticia = '$id_not'";
            $_SESSION['criada'] = 4;
        }
        $i++;
        $n++;
    }
};
?>




