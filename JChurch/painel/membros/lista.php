<?php
@session_start();
require_once('../../config/conect.php');

$sql = $pdo->query("SELECT * FROM membro;");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0) {
?>
    <div class="row">
        <?php
        for ($c = 0; $c < count($res); $c++) {
            $id_mem = $res[$c]["id_membro"];
            $nome = $res[$c]["nome_mem"];
            $data_nasc = $res[$c]["nasc_mem"];
            $sexo = $res[$c]["sexo_mem"];
            $cargo = $res[$c]["cargo_mem"];
            $emprego = $res[$c]["emprego_mem"];
            $telefone = $res[$c]["telefone_mem"];
            $endereco = $res[$c]["endereco"];
            $foto = $res[$c]["foto_mem"];
            $banner = $res[$c]["banner"];

            $id_usuario = $res[$c]["id_usuario"];

            $nasc = implode('/', array_reverse(explode('-', $data_nasc)));

            $ano_de_nasc = explode('-', $data_nasc);
            $idade = Date('Y') - $ano_de_nasc[0];

            $sql_2 = $pdo->query("SELECT * FROM usuarios WHERE id_usuario = '$id_usuario'");
            $res_2 = $sql_2->fetchAll(PDO::FETCH_ASSOC);
            $posto = $res_2[0]['posto'];
            if (count($res_2) > 0) {
                if ($res_2[0]['id_usuario'] == $id_usuario && $res_2[0]['id_usuario'] == $_SESSION['id']) {
                    $style = 'background:rgb(121, 102, 88); color: white';
                    $nome_2 = 'Você';
                    $editar_perfil = true;
                } else {
                    $style = 'background:rgb(211, 211, 211);';
                    $nome_2 = $nome;
                    $editar_perfil = false;
                }
            } else {
                $style = 'background:rgb(211, 211, 211);';
                $nome_2 = $nome;
                $editar_perfil = false;
            }

        ?>
            <div class="col-md-4">
                <div class="card card-widget widget-user" style="<?= $style ?>">
                    <div class="widget-user-header text-white"
                        style="background: url('imagens/banners/<?= $banner ?>') center center no-repeat;">
                        <h3 class="widget-user-username text-right"><?= $nome_2 ?></h3>
                        <h5 class="widget-user-desc text-right"><?= $emprego ?></h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalInformacoes<?= $id_mem ?>" src="imagens/<?= $foto ?>" alt="Foto de Perfil">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">0</h5>
                                    <span class="description-text">Pedidos de Orações</span>
                                </div>
                            </div>
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">0</h5>
                                    <span class="description-text">Leituras</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header"><?= $posto ?></h5>
                                    <span class="description-text">Posto</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalInformacoes<?= $id_mem ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="d-flex flex-wrap flex-column">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Informações</h1>
                                <a href="index.php?pag=publicacoes&id_membro=<?=$id_mem?>">Publicações</a>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col border">
                                        <p class="mb-0" style="background-color: gray; width: 100%">Nome:</p>
                                        <p><?= $nome ?></p>
                                    </div>
                                    <div class="col">
                                        <p class="mb-0">Data de Nascimento / Idade</p>
                                        <p>
                                            <?= $nasc . " / " . $idade . " Anos " ?>
                                        </p>
                                    </div>
                                    <div class="col">
                                        <p class="mb-0">Sexo:</p>
                                        <p>
                                            <?php echo ($sexo == "F") ? "Feminino" : "Masculino" ?>
                                        </p>
                                    </div>
                                    <div class="col">
                                        <p class="mb-0">Ocupação:</p>
                                        <p>
                                            <?php echo $cargo ?>
                                        </p>
                                    </div>
                                    <div class="col">
                                        <p class="mb-0">Telefone:</p>
                                        <p>
                                            <?= $telefone ?>
                                        </p>
                                    </div>
                                    <div class="col">
                                        <p class="mb-0">Endereço:</p>
                                        <p>
                                            <?php echo $endereco ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="widget-user-image">
                                        <img class="" src="imagens/<?= $foto ?>" alt="Foto de Perfil" height="300">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <?php
                            if ($editar_perfil) {
                            ?>
                                <a href="index.php?pag=editar-perfil" class="btn btn-primary">Editar Perfil</a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
<?php
}

?>