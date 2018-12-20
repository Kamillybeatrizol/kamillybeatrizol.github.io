<?php
include ('verifica_login.php');
include ('conexao.php');

// Verificar se imagens foram adicionadas

$_SESSION['update_img'];

if($_FILES['image']['size'][0] === 0) {
    $_SESSION['update_img'] = false;
} else {
    $_SESSION['update_img'] = true;
};

$t = $_POST["titulo"];
$d = $_POST["descricao"];
$de = $_POST["data_expira"];


if($t == "" or $d == "" or $de == "" or $_SESSION['update_img'] == false){
    header("Location: listagem.php");
    $_SESSION['aviso'] = 4;

} else {

    $_SESSION['aviso'] = 0;

// Verificar se título selecionado já existe

    $titulo = filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_STRING);
    $id_not = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM noticias";
    $executar = mysqli_query($conn, $query);

    $existe = false;

    while ($row_user = mysqli_fetch_assoc($executar)) {
        if ($row_user['titulo'] == $titulo and $row_user['id_noticia'] != $id_not)
            $existe = true;
    };

// Caso o título ainda não exista. Realizo a operação de atualização.

    if ($existe == false){
        $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
        $data_expiracao = filter_input(INPUT_POST, 'data_expira');


        $query = "UPDATE noticias SET titulo='$titulo', descricao='$descricao', data_expiracao = '$data_expiracao'  WHERE id_noticia='$id_not'";
        $executar = mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn)){
            $_SESSION['aviso'] = 1;
            if ($_SESSION['update_img'] = false){
                header("Location: listagem.php");
            };
        }else {
            header("Location: listagem.php");
            $_SESSION['aviso'] = 2;
        };
    } else {
        header("Location: listagem.php");
        $_SESSION['aviso'] = 3;
    };

// Alteração de imagens

    if ($_SESSION['update_img'] = true) {

        $_SESSION['apagou'] = false;

// Apagando antigo registro de imagem (no banco e na pasta do servidor)

        $query_a = "SELECT * FROM imagens WHERE id_noticia = $id_not";
        $executar_a = mysqli_query($conn, $query_a);


        while ($row_user = mysqli_fetch_assoc($executar_a)) {
            $id_img = $row_user['id_imagem'];
            $img = $row_user['caminho'];
            $caminho = 'imagens/' . $img;
            unlink($caminho);
            $query_d = "DELETE FROM imagens WHERE id_imagem = $id_img";
            $executar_d = mysqli_query($conn, $query_d);
        };

        if (mysqli_affected_rows($conn)) {
            $_SESSION['apagou'] = true;
        } else {
            header("Location: listagem.php");
            $_SESSION['aviso'] = 2;
        };
    };

    #Selecionar maior id da tabela de imagens

    $query_max = "SELECT MAX(id_imagem) AS MAXID FROM imagens";
    $result = mysqli_query($conn, $query_max);
    $row = mysqli_fetch_array($result);

    $mid = $row["MAXID"];

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
                header("Location: listagem.php");
            }else{
                $query3 = "DELETE FROM noticias WHERE id_noticia = '$id_not'";
                $_SESSION['criada'] = 4;
            }
            $i++;
            $n++;
        }
    };


};





