<?php
require_once('../index_php/protect.php');
require_once('../config/conect.php');

@session_start();

$sql = $pdo->query("SELECT * FROM membro WHERE id_usuario = '$_SESSION[id]'");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0) {
    $id_membro = $res[0]['id_membro'];
}

?>

<section class="text-center">
    <h1 class="berkshire">Orações Salvas</h1>
</section>

<div class="container">
    <div class="d-flex flex-wrap">
        <?php
            $sql = $pdo->query("SELECT * FROM le_pedidos WHERE id_membro = '$id_membro'");
            $res = $sql->fetchAll(PDO::FETCH_ASSOC);
            if (count($res) > 0) {
                for ($i = 0; $i < count($res); $i++) {
        
                    $id_mo = $res[$i]['id_mo'];
        
        
                    $sql_mo = $pdo->query("SELECT * FROM minhas_oracoes WHERE id_mo = '$id_mo'");
                    $res_mo = $sql_mo->fetchAll(PDO::FETCH_ASSOC);
                    if (count($res_mo) > 0) {
                        $id_le_membro = $res_mo[0]['id_membro'];
        
                        $sql_mem = $pdo->query("SELECT * FROM membro WHERE id_membro = '$id_le_membro'");
                        $res_mem = $sql_mem->fetchAll(PDO::FETCH_ASSOC);
                        $foto = $res_mem[0]['foto_mem'];
                    }
        
                    ?>
                    <div class="card" style="width: 18rem;">
                        <img src="imagens/<?php echo $foto ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                    <?php
                }
            }
        ?>
    </div>
</div>