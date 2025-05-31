<?php 
require_once('../../config/conect.php');

$sql = $pdo->query("SELECT * FROM usuarios WHERE posto = 'Levita'");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0) {
    ?>
    <div class="row">
        <?php 
            for ($i = 0; $i < count($res); $i++) {
                
            }
        ?>
    </div>
    <?php
}
?>