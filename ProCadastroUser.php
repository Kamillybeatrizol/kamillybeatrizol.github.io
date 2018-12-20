<?php
include ('verifica_login.php');
?>

<?php
include_once ("conexao.php");

$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);

if($nome == "" or $senha == ""){
    header("Location: CadastroUser.php");

} else {

    $query = "SELECT * FROM usuarios";
    $executar = mysqli_query($conn, $query);

    $existe = false;

    while ($row_user = mysqli_fetch_assoc($executar)){
        if ($row_user['login'] === $nome){
            $existe = true;
            $_SESSION['criado'] = "Erro ao cadastrar novo usuário, nome usado já existe, insira um diferente.";
            header("Location: CadastroUser.php");
        }
    };


    if ($existe == false){

        $query1 = "INSERT INTO usuarios (login, senha) VALUES ('$nome', '$senha')";
        $executar1 = mysqli_query($conn, $query1);

        if (mysqli_insert_id($conn)){
            header("Location: CadastroUser.php");

            $_SESSION['criado'] = 'Usuário criado com sucesso';

        }else{
            header("Location: CadastroUser.php");
            $_SESSION['criado'] = 'Não foi possível cadastrar novo usuário';

        };
    };

};

?>
