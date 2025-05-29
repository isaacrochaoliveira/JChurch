<?php
@session_start();
require_once('../../config/conect.php');

$id_membro = $_SESSION['id'];

$nome = addslashes($_POST['nome']);
$nasc = addslashes($_POST['nasc']);
$sexo = addslashes($_POST['sexo']);
$cargo = addslashes($_POST['cargo']);
$emprego = addslashes($_POST['emprego']);
$telefone = addslashes($_POST['telefone']);
$endereco = addslashes($_POST['endereco']);

$sql = $pdo->query("UPDATE membro SET nome_mem = '$nome', sexo_mem = '$sexo', nasc_mem = '$nasc', cargo_mem = '$cargo', emprego_mem = '$emprego', telefone_mem = '$telefone', endereco = '$endereco' WHERE id_usuario = '$id_membro'");

echo "Atualizado com Sucesso!";
