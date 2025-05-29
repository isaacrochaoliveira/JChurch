<?php 

require_once('../../config/conect.php');
@session_start();

$id_mo = $_POST['id_mo'];
$titulo = $_POST['titulo'] ?? '' ;
$motivo = $_POST['motivo'] ?? '' ;
$versiculo = $_POST['versiculo'] ?? '' ;
$versiculo_txt = $_POST['versiculo_txt'] ?? '' ;
$link_ajuda1 = $_POST['link_ajuda1'] ?? '' ;
$link_ajuda2 = $_POST['link_ajuda2'] ?? '' ;
$link_ajuda3 = $_POST['link_ajuda3'] ?? '' ;
$titulo_video1 = $_POST['titulo_video1'] ?? '' ;
$titulo_video2 = $_POST['titulo_video2'] ?? '' ;
$titulo_video3 = $_POST['titulo_video3'] ?? '' ;
$desc = $_POST['desc'] ?? '' ;

$sql = $pdo->query("SELECT * FROM minhas_oracoes WHERE id_mo = '$id_mo'");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0) {
    $tituloCad = $res[0]['titulo'];
}

if ($titulo == '') {
    $titulo = $tituloCad;
}

$sql = $pdo->query("UPDATE minhas_oracoes SET titulo = '$titulo', txt_mo = '$desc', motivo = '$motivo', versiculo = '$versiculo', versiculo_txt = '$versiculo_txt', link_video1 = '$link_ajuda1', link_video2 = '$link_ajuda2', link_video3 = '$link_ajuda3', titulo_video1 = '$titulo_video1', titulo_video2 = '$titulo_video2', titulo_video3 = '$titulo_video3' WHERE id_mo = '$id_mo'");

echo "Atualizado Com Sucesso!";
