<?php 
require_once('../../config/conect.php');
@session_start();

$descricao = addslashes($_POST['descricaoP']);
$id_publi = addslashes($_POST['idP']);
$hashtags = addslashes($_POST['hashtags']);

$sql = $pdo->query("UPDATE publicacoes SET descricao_p = '$descricao', hashtag_p = '$hashtags' WHERE id_publi = '$id_publi'");
