<?php 
require_once('../config/conect.php');

$criP = "";

$email = $_POST['email'];
$senha = $_POST['senha'];

if ($email == "") {
    echo "E-mail inválido";
    exit();
}

if (($senha == "") || (strlen($senha) < 8)) {
    echo "Senha Inválida! Tente outra com mais de 8 caracteres.";
    exit();
}

$sql = $pdo->query("SELECT * FROM usuarios WHERE email = '$email'");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0) {
    echo "Email já Existente!";
    exit();
} else {
    $criP = password_hash($senha, PASSWORD_DEFAULT);
    $pdo->query("INSERT INTO usuarios SET email = '$email', senha = '$criP'");
    $pdo->query("INSERT INTO membro SET id_usuario = LAST_INSERT_ID() ,foto_mem = 'foto-de-perfil.jpg', banner = 'boy-drildren.png'");
    echo "Salvo com Sucesso!";
}


?>