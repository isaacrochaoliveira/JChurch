<?php
@session_start();
require("../config/conect.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

if ($email == '') {
    echo "Email inválido!";
    exit();
}

if ($senha == "") {
    echo "Senha Inválida!";
    exit();
}

$sql = $pdo->query("SELECT * FROM usuarios WHERE email = '$email'");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
if (count($res) == 0) {
    echo "Email incorreto ou não cadastrado!";
    exit();
} else {
    if (password_verify($senha, $res[0]['senha'])) {
        $_SESSION['id'] = $res[0]['id_usuario'];
        $_SESSION['email'] = $res[0]['email'];

        echo "Salvo com Sucesso!";
    }
}
