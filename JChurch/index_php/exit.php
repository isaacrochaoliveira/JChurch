<?php 
@session_start();
if ($_SESSION['id'] != "") {
    session_destroy();
}

header("Location: ../index.php");
?>