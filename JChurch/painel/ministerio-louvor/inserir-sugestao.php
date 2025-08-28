<?php 
require_once("../../config/conect.php");

print_r($_POST);
exit;

$author = addslashes($_POST['author_musica']);
$title = addslashes($_POST['nome_musica']);
$duration = addslashes($_POST['duracao_musica']);

echo $author;