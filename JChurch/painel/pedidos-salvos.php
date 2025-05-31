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
    <p>Tire um Momento com Deus para colocar essas orações diante de suas Mãos. Entrege a Ele tudo o que tá em seu coração e ajude o seu próximo</p>
</section>

<div class="container">
    <div class="d-flex flex-wrap py-5">
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
                    $legenda = $res_mo[0]['txt_mo'];


                    $sql_mem = $pdo->query("SELECT * FROM membro WHERE id_membro = '$id_le_membro'");
                    $res_mem = $sql_mem->fetchAll(PDO::FETCH_ASSOC);
                    $foto = $res_mem[0]['foto_mem'];
                    $nome = $res_mem[0]['nome_mem'];

                    $nasc = implode('/', array_reverse(explode('-', $res_mem[0]['nasc_mem'])));

                    $ano = explode('/', $nasc);
                    $idade = date('Y') - $ano[2];
                }
        ?>
                <style>
                    .card {
                        cursor: pointer;
                        width: 19rem;
                        border: 2px solid black;
                        box-shadow: 3px 4px 2px black;
                    }

                    .card .le_in<?= $id_le ?> {
                        display: none;
                    }

                    .card:hover img {
                        opacity: 0.6;
                        border-radius: 50px;
                    }

                    .card:hover .le_in<?= $id_le ?> {
                        display: block;
                    }
                </style>
                <div class="col-md-3">
                    <div class="card">
                        <img src="imagens/<?php echo $foto ?>" class="card-img-top" alt="...">
                        <div class="card-body le_in<?= $id_le ?> ">
                            <p><?php echo $nome?> - <?php echo $idade?> Anos</p>
                            <hr>
                            <p><?php echo $legenda ?></p>
                            <div>
                                <button class="btn btn-outline-danger" onclick="excLe(<?php echo $id_le ?>)"><i class="fa-solid fa-bookmark"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>

<script>
    function excLe(id_le) {
        $.ajax({
            url: 'pedidos-salvos/excLe.php',
            method: 'post',
            data: {id_le},
            success: function(msg) {
                if (msg.trim() == 'EXC') {
                    location.reload();
                } else {
                    alert(msg);
                }
            }
        })
    }
</script>