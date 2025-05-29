<?php 
require_once('../../config/conect.php');

$id_mo = $_POST['id_mo'];

$pdo->query("DELETE FROM minhas_oracoes WHERE id_mo = '$id_mo'");

echo "Com Sucesso!";

?>