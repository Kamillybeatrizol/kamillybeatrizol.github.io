<?php
include_once ('conexao.php');
error_reporting(E_ALL);

$servidor = 'localhost';
$usuario = "root";
$senha = '';
$bdname = "noticiario";


//Para criar a conexação

$conn = mysqli_connect($servidor, $usuario, $senha, $bdname) or die ('Não foi possível conectar ao banco de dados');


