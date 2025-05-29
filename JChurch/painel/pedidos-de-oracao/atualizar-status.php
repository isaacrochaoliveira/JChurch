<?php 
require_once('../../config/conect.php');

$id_mo = $_POST['id_mo'];
$status = $_POST['status'];

$pdo->query("UPDATE minhas_oracoes SET status = '$status' WHERE id_mo = '$id_mo'");
echo 'Status atualizado com sucesso!';

