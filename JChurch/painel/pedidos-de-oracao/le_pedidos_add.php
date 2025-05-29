<?php 

require_once('../../config/conect.php');
@session_start();
date_default_timezone_set('America/Sao_Paulo');

$id_mo = $_POST['id_mo'];
$data = date('Y-m-d');
$hora = date('H:i:s', time());

$sql = $pdo->query("SELECT * FROM membro WHERE id_usuario = '$_SESSION[id]'");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
$id_membro = $res[0]['id_membro'];

$pdo->query("INSERT INTO le_pedidos SET id_mo = '$id_mo', id_membro = '$id_membro', data = '$data', hora = '$hora'");

echo "Pedido Add com Sucesso!";

