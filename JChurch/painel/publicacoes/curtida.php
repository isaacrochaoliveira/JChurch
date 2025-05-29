<?php 

require_once('../../config/conect.php');
@session_start();


$id_publi = $_POST['id_public'];
$id_user = $_SESSION['id'];
$data = date('Y-m-d');
$action = $_POST['action'];

if ($action == 'like') {
    $sql = $pdo->query("SELECT * FROM publicacoes WHERE id_publi = '$id_publi'");
    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
    if (count($res) > 0) {
        $ncurtidas = $res[0]['curtidas_p'];
        $ncurtidas++;
    }
    $pdo->query("INSERT INTO curtidas SET id_publi = '$id_publi', id_usuario = '$id_user', data = '$data'");
    $pdo->query("UPDATE publicacoes SET curtidas_p = '$ncurtidas' WHERE id_publi = '$id_publi'");
} else if ($action == 'unlike') {
    $sql = $pdo->query("SELECT * FROM publicacoes WHERE id_publi = '$id_publi'");
    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
    if (count($res) > 0) {
        $ncurtidas = $res[0]['curtidas_p'];
        $ncurtidas--;
    }
    $pdo->query("DELETE FROM curtidas WHERE id_publi = '$id_publi' AND id_usuario = '$id_user'");
    $pdo->query("UPDATE publicacoes SET curtidas_p = '$ncurtidas' WHERE id_publi = '$id_publi'");
}


echo "$ncurtidas";