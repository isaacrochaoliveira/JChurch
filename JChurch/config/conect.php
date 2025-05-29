<?php 

require('config.php');

try {
    $pdo = new PDO("mysql:dbname=".BANCO.";host=".HOST.";charset=".CHARSET, USUARIO, SENHA_DO_BANCO);
} catch (PDOException $e) {
    echo "". $e->getMessage();
}
