<?php 

require_once("../../config/conect.php");
@session_start();

$id = $_POST['id_sug'];

if ($id) {
    $sql = $pdo->prepare("UPDATE sugestao_musicas SET status = 'Aprovado' WHERE id_sug = :id");
    $sql->bindValue(":id", $id);
    if ($sql->execute()) {
        
        $sql = $pdo->query("SELECT * FROM sugestao_musicas WHERE id_sug = $id");
        $res = $sql->fetch(PDO::FETCH_ASSOC);
        $titulo_musica = $res['tituto_sug'];
        $author_musica = $res['author_sug'];

        $pdo->query("INSERT INTO musicas_ministerio SET titulo_musica = '$titulo_musica', author_musica = '$author_musica'");
        echo "Aprovado com Sucesso!";
    } else {
        echo "Erro ao Aprovar Sugestão!";
    }
}
?>