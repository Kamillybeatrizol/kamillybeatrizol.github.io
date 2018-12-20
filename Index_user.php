<?php
include ('verifica_login.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>NOTICIÁRIO</title>

</head>
<body>

<link rel="stylesheet" href="./projeto/reveal.min.css">
<link rel="stylesheet" href="./projeto/sky.css" id="theme">
<link type="text/css" rel="stylesheet" charset="UTF-8" href="./projeto/translateelement.css">


<div class="cima">NOTICIÁRIO INSTITUCIONAL <br>
    <button style=" background-color: #90EE90; border-radius: 6px" ><a href="cadastroNot.php">Cadastrar notícia</a></button>
    <button style=" background-color: #90EE90; border-radius: 6px"><a href="cadastroUser.php">Cadastrar usuário</a></button>
    <button style=" background-color: #90EE90; border-radius: 6px"><a href="listagem.php">Suas notícias</a></button>
    <button style=" background-color: #90EE90; border-radius: 6px"><a href='excluir_conta.php?' onClick="javascript:return confirm('Tem certeza que deseja excluir sua conta?');">Excluir conta</a></button>
    <button style=" background-color: #90EE90; border-radius: 6px"><a href="altera_senha1.php">Alterar senha</a></button>
    <button style=" background-color: #98FB98; border-radius: 6px" ><a href="logout.php">Sair</a></button>
</div>



<div class="ladoum">
    <center>
        <!-- CODIGO QUE INCORPORA O VIDEO DO IFRN - PARNAMIRIM -->
        <iframe width="400" height="300" src="https://www.youtube.com/embed/_Xjtv5gW7VU?autoplay=1" frameborder="0" allowfullscreen></iframe>
        <br>

        <!-- integração com redes sociais -->
        <!-- FACEBOOK -->
        <a href ="https://www.facebook.com/" target="_blank">
            <img src="facebook.png" width="100" height="100" />
        </a>


        <!-- INSTAGRAM -->
        <a href = "https://www.instagram.com/?hl=pt-br" target="_blank">
            <img src= "instagram.png" width="100" height="100" />
        </a>

        <!-- CODIGO DE DATA E HORA (INICIO) -->

        <script src="https://code.jquery.com/jquery-1.11.2.js"></script>
        <script type="text/javascript"> jQuery(window).load(function($){atualizaRelogio();});  </script>
        <div>
            <output id="data" style="font-family: 'courier'; font-size: 60px;"></output> <!-- DEFINIÇÕES DE DATA -->
        </div>
        <div>
            <output id="hora" style="font-family: 'courier'; font-size: 60px;"></output> <!-- DEFINIÇÕES DA HORA -->
        </div>
        <script>
            function atualizaRelogio(){
                var momentoAtual = new Date();

                var vhora = momentoAtual.getHours();
                var vminuto = momentoAtual.getMinutes();
                var vsegundo = momentoAtual.getSeconds();

                var vdia = momentoAtual.getDate();
                var vmes = momentoAtual.getMonth() + 1;
                var vano = momentoAtual.getFullYear();

                if (vdia < 10){ vdia = "0" + vdia;}
                if (vmes < 10){ vmes = "0" + vmes;}
                if (vhora < 10){ vhora = "0" + vhora;}
                if (vminuto < 10){ vminuto = "0" + vminuto;}
                if (vsegundo < 10){ vsegundo = "0" + vsegundo;}

                dataFormat = vdia + "/" + vmes + "/" + vano;
                horaFormat = vhora + ":" + vminuto + ":" + vsegundo;

                document.getElementById("data").innerHTML = dataFormat;
                document.getElementById("hora").innerHTML = horaFormat;
                setTimeout("atualizaRelogio()",1000);
            }
        </script> <!-- TERMINA AQUI O CODIGO REFERENTE A DATA E HORA -->
    </center>

</div>

<div class="bv">
    <?php

    if (isset($_SESSION['aviso'])) {

        if ($_SESSION['aviso'] === 1) {
            echo "<p>Operação realizada com sucesso.</p>";
        } elseif ($_SESSION['aviso'] === 2) {
            echo "<p>Erro na operação</p>";
        }
        $_SESSION['aviso'] = 0;
    }
    ?>
</div>

<div class="reveal">

    <div class="slides">
        <?php
        include_once ("conexao.php");

        $query = "SELECT * FROM noticias where data_expiracao >= NOW();";
        $executar = mysqli_query($conn, $query);

        while ($row_user = mysqli_fetch_assoc($executar)){

            $id_not = $row_user['id_noticia'];

            $query3 = "SELECT * FROM imagens WHERE id_noticia = $id_not;";

            $executar3 = mysqli_query($conn, $query3);

            while ($row_user = mysqli_fetch_assoc($executar3)){

                echo "<section class=\"past\" style=\"top: -276.5px; display: block;\">";
                echo "<div class=\"coluna\">";
                $img = $row_user['caminho'];
                $alt = $row_user['legenda'];
                $caminho = 'imagens/'.$img;
                echo "<img src='$caminho' alt='$alt'>";
                echo " </div>";
                echo "</section>";
            };
        };
        ?>
    </div>
</div>

<script src="./projeto/head.min.js.download"></script>
<script src="./projeto/reveal.min.js.download"></script>

<script>
    Reveal.initialize({
        loop: true,
        autoSlide: 0,
        autoSlide: 5000,
        center: true,
        controls: true,
        mouseWheel: true,
        transition: 'slide'
    });
</script>



</body>
</html>

