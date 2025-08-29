<?php 
require_once("../../config/conect.php");

$author = addslashes($_POST['author_musica']);
$title = addslashes($_POST['nome_musica']);
$link = addslashes($_POST['link_musica']);
$ano = addslashes($_POST['ano_lanc_sub']);

if ($author == "" || $title == "" || $link == "" || $ano == "") {
    echo "<script>alert('Preencha todos os campos!');location.href='../ministerio-louvor.php';</script>";
} else {
    $pdo->query("INSERT INTO sugestao_musicas (author_sug, tituto_sug, link_sug, ano_lanc_sug) VALUES ('$author', '$title', '$link', '$ano')");
    echo "Inserido com Sucesso!";
}
