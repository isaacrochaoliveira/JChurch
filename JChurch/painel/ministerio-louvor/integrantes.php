<?php
require_once('../../config/conect.php');

$sql = $pdo->query("SELECT * FROM usuarios WHERE posto = 'Levita'");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0) {
?>
    <div class="row">
        <?php
        for ($i = 0; $i < count($res); $i++) {
            $id_usuario = $res[$i]['id_usuario'];
            $posto = $res[$i]['posto'];

            $sql_2 = $pdo->query("SELECT * FROM membro WHERE id_usuario = '$id_usuario'");
            $res_2 = $sql_2->fetchAll(PDO::FETCH_ASSOC);
            $id_membro = $res_2[0]['id_membro'];
            $foto_mem = $res_2[0]['foto_mem'];
            $nome_mem = $res_2[0]['nome_mem'];
            $cargo_mem = $res_2[0]['cargo_mem'];

            @$sql_3 = $pdo->query("SELECT * FROM publicacoes WHERE id_membro = '$id_membro' LIMIT 3;");
            @$res_3 = $sql_3->fetchAll(PDO::FETCH_ASSOC);
            @$foto_p = $res_3[0]['foto_p'];
            @$descricao_p = $res_3[0]['descricao_p'];
            @$hashtag_p = $res_3[0]['hashtag_3'];
            @$data = $res_3[0]['data'];
            @$hora = $res_3[0]['hora'];

            @$dataF = implode('/', array_reverse(explode('-', $data)));


        ?>
            <div class="d-flex flex-wrap py-5">
                <div class="w-50">
                    <div class="text-center">
                        <img src="./imagens/<?php echo $foto_mem ?>" alt="Foto de Perfil" width="380">
                    </div>
                </div>
                <div class="w-50">
                    <div>
                        <a href="index.php?pag=publicacoes&id_membro=<?php echo $id_membro ?>">Perfil <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <d class="d-flex flex-wrap">
                        <?php
                        if (count($res_3) > 0) {
                            for ($c = 0; $c < count($res_3); $c++) {
                                $foto_p = $res_3[$c]['foto_p'];
                                $descricao_p = $res_3[$c]['descricao_p'];
                                $hashtag_p = $res_3[$c]['hashtag_p'];
                                $data = $res_3[$c]['data'];
                                $hora = $res_3[$c]['hora'];

                                $dataF = implode('/', array_reverse(explode('-', $data)));
                        ?>
                                <div class="col-md-5">
                                    <div class="d-flex flex-wrap flex-column">
                                        <p class="mb-0"><?php echo $dataF ?> - <?php echo $hora ?></p>
                                        <img src="./imagens/publis/<?php echo $foto_p ?>" alt="" width="250">
                                        <div>
                                            <p class="mb-0 mt-2 f-18px"><strong><?php echo $descricao_p ?></strong></p>
                                            <p class=""><?php echo $hashtag_p ?></p>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p>Sem Publicações deste membro!</p>";
                        }
                        ?>
                    </d>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
<?php
}
?>