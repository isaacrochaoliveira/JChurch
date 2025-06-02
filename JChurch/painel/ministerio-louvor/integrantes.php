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

            @$sql_3 = $pdo->query("SELECT * FROM publicacoes WHERE id_membro = '$id_membro'");
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
                        <hr>
                        <p>
                            <?php
                            echo $nome_mem . "<br>" . $posto . "<br>" . $cargo_mem;
                            ?>
                        </p>
                    </div>
                </div>
                <div class="w-50">
                    <d class="flex flex-wrap">
                        <div>
                            <?php 
                                if (count($res_3) > 0) {
                                    ?>
                                        <div class="d-flex flex-wrap flex-column">
                                            <p class="mb-0"><?php echo $dataF ?> - <?php echo $hora ?></p>
                                            <img src="./imagens/publis/<?php echo $foto_p ?>" alt="" width="400">
                                            <div>
                                                <p class="mb-0 mt-2 f-18px"><strong><?php echo $descricao_p ?></strong></p>
                                                <p class=""><?php echo $hashtag_p ?></p>
                                            </div>
                                        </div>
                                    <?php
                                } else {
                                    echo "<p>SemPublicações deste membro!<p>";
                                }
                            ?>
                        </div>
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