<?php 

require_once('../../config/conect.php');

$id_le = $_POST['id_le'];

if ($id_le == "") {
    echo "Código de Oração Inválida!";
    exit;
}

$pdo->query("DELETE FROM le_pedidos WHERE id_le = '$id_le'");

echo "EXC";

?>