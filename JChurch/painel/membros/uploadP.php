<?php
require_once('../../config/conect.php');
@session_start();

date_default_timezone_set('America/Sao_Paulo');
$midia = preg_replace('/[ -]+/', '-', @$_FILES['foto_p']['name']);


$caminhoPublicacoes = '../imagens/publis/' . $midia;

$midiaTemp = @$_FILES['foto_p']['tmp_name'];

if ($_FILES['foto_p']['name'] == "") {
    $nomeMidia = "sem-foto.jpg";
} else {
    $nomeMidia = $midia;
}


$midiaExt = pathinfo($midia, PATHINFO_EXTENSION);
if ($midiaExt == 'webp' or $midiaExt == 'jpg' or $midiaExt == 'jpeg') {
    move_uploaded_file($midiaTemp, $caminhoPublicacoes);
} else {
    echo 'Extensão de Imagem não permitida!';
    exit();
}

$sql = $pdo->query("SELECT * FROM membro WHERE id_usuario = '" . $_SESSION['id'] . "'"); 
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
$id_membro = $res[0]['id_membro'];       

$sql = $pdo->prepare("INSERT INTO publicacoes SET id_membro = :id, foto_p = :foto_p, data = :data, hora = :hora");
$sql->bindValue(':id', $id_membro);
$sql->bindValue(':foto_p', $nomeMidia);
$sql->bindValue(':data', date('Y-m-d'));
$sql->bindValue(':hora', date('G:i:s', time()));
$sql->execute();
$idP = $pdo->lastInsertId();

if ($sql) {
    echo "Foto Atualizada com Sucesso!###$idP";
} else {
    echo "Erro ao atualizar a foto!'";
}
