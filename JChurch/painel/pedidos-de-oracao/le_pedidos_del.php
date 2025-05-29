<?php 

require_once('../../config/conect.php');
@session_start();

$id_mo = $_POST['id_mo'];

$sql = $pdo->query("SELECT * FROM membro WHERE id_usuario = '$_SESSION[id]'");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
$id_membro = $res[0]['id_membro'];

$pdo->query("DELETE FROM le_pedidos WHERE id_mo = '$id_mo' AND id_membro = '$id_membro'");

echo "Pedido Removido com Sucesso!";