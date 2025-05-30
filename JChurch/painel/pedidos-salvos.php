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
    <div class="d-flex flex-wrap flex-row py-5">
        <?php
        $sql = $pdo->query("SELECT * FROM le_pedidos WHERE id_membro = '$id_membro'");
        $res = $sql->fetchAll(PDO::FETCH_ASSOC);
        if (count($res) > 0) {
            for ($i = 0; $i < count($res); $i++) {
                $id_le = $res[$i]['id_le'];
                $id_mo = $res[$i]['id_mo'];
                $sql_mo = $pdo->query("SELECT * FROM minhas_oracoes WHERE id_mo = '$id_mo'");
                $res_mo = $sql_mo->fetchAll(PDO::FETCH_ASSOC);
                if (count($res_mo) > 0) {
                    $id_le_membro = $res_mo[0]['id_membro'];
                    $sql_mem = $pdo->query("SELECT * FROM membro WHERE id_membro = '$id_le_membro'");
                    $res_mem = $sql_mem->fetchAll(PDO::FETCH_ASSOC);
                    $foto = $res_mem[0]['foto_mem'];
                    $nome = $res_mem[0]['nome_mem'];
                }
        ?>
                <style>
                    .card-le {
                        width: 30rem;
                    }

                    .card-le .le_in<?= $id_le ?> {
                        display: none;
                    }

                    .card-le:hover img {
                        cursor: pointer;
                        opacity: 0.6;
                        border-radius: 50px;
                    }

                    .card-le:hover .le_in<?= $id_le ?> {
                        display: block;
                    }
                </style>
                <div class="col-md-6">
                    <div class="card-le d-flex flex-wrap flex-row">
                        <div class="col-md-6">
                            <img src="imagens/<?php echo $foto ?>" class="card-img-top" alt="...">
                        </div>
                        <div class="le_in<?= $id_le ?> col-md-6">
                            <p><?php echo $nome_mem?></p>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>