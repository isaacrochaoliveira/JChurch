<?php
require_once('../../config/conect.php');

@session_start();

$sql = $pdo->query("SELECT *");
?>