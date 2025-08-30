<?php 

require_once("../../config/conect.php");
@session_start();

$id = $_POST['id_sug'];

if ($id) {
    $sql = $pdo->prepare("UPDATE sugestao_musicas SET status = 'Rejeitado'   WHERE id_sug = :id");
    $sql->bindValue(":id", $id);
    if ($sql->execute()) {
        echo "Rejeitado com Sucesso!";
    } else {
        echo "Erro ao Rejeitar Sugestão!";
    }
}
?>