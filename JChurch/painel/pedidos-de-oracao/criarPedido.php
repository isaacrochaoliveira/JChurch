<?php 

date_default_timezone_set('America/Sao_Paulo');

$data = date('Y-m-d');
$hora = date('H:i:s', time());

require_once('../../config/conect.php');
@session_start();

$legenda = addslashes($_POST['legenda']);

$sql = $pdo->query("SELECT * FROM membro WHERE id_usuario = '$_SESSION[id]'");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
$id_membro = $res[0]['id_membro'];

if (strlen($legenda) == 0) {
    echo "A Legenda não pode ficar vazia!";
    exit();
}

$pdo->query("INSERT INTO minhas_oracoes SET txt_mo = '$legenda', id_membro = '$id_membro', data = '$data', hora = '$hora'");

echo "Oração Criada!";

?>