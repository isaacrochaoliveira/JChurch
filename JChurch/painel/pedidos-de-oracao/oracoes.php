<?php

require_once('../../config/conect.php');
@session_start();


$tot_videos = 0;
$id_membro = $_POST['id_membro'];
$sql = $pdo->query("SELECT * FROM minhas_oracoes ORDER BY id_mo DESC");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0) {
?>
    <div class="d-flex flex-wrap flex-row">
        <?php
        for ($i = 0; $i < count($res); $i++) {
            $id_mo = $res[$i]['id_mo'];
        ?>
            <div class="modal fade" id="VerVideos<?= $id_mo ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Versículo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="bg-dark" style="height: 100%;">
                                <?php
                                if (($res[$i]['link_video1'] <> '') || ($res[$i]['link_video2'] <> '') || ($res[$i]['link_video3'] <> '')) {
                                    @$video1 = $res[$i]['link_video1'];
                                    @$video2 = $res[$i]['link_video2'];
                                    @$video3 = $res[$i]['link_video3'];
                                    if ($video1 <> "") {
                                        $tot_videos += 1;
                                    }
                                    if ($video2 <> "") {
                                        $tot_videos += 1;
                                    }
                                    if ($video3 <> "") {
                                        $tot_videos += 1;
                                    }
                                    @$titulo1 = $res[$i]['titulo_video1'];
                                    @$titulo2 = $res[$i]['titulo_video2'];
                                    @$titulo3 = $res[$i]['titulo_video3'];
                                    @$link1 = explode('watch?v=', $video1);
                                    @$video1_embed = $link1[0] . 'embed/' . $link1[1];
                                    @$link2 = explode('watch?v=', $video2);
                                    @$video2_embed = $link2[0] . 'embed/' . $link2[1];
                                    @$link3 = explode('watch?v=', $video3);
                                    @$video3_embed = $link3[0] . 'embed/' . $link3[1];
                                ?>
                                    <div id="carouselExampleCaptions<?= $id_mo ?>" class="carousel slide text-center" data-bs-ride="carousel" style="height: 100%; width: 100%">
                                        <div class="carousel-indicators">
                                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        </div>
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <iframe width="100%" height="850"
                                                    src="<?php echo $video1_embed ?>"
                                                    title="YouTube video player" frameborder="1"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
                                                </iframe>
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5><?php echo $titulo1 ?></h5>
                                                    <a href="<?php echo $video1 ?>" target="_blank"><?php echo $video1 ?></a>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <iframe width="100%" height="850"
                                                    src="<?php echo $video2_embed ?>"
                                                    title="YouTube video player" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
                                                </iframe>
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5><?php echo $titulo2 ?></h5>
                                                    <a href="<?php echo $video2 ?>" target="_blank"><?php echo $video2 ?></a>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <iframe width="100%" height="850"
                                                    src="<?php echo $video3_embed ?>"
                                                    title="YouTube video player" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
                                                </iframe>
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5><?php echo $titulo3 ?></h5>
                                                    <a href="<?php echo $video3 ?>" target="_blank"><?php echo $video3 ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions<?= $id_mo ?>" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions<?= $id_mo ?>" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                <?php
                                } else {
                                    echo "<h3>Vídeos Nâo Incluídos ou não Encontrados!";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $titulo = $res[$i]['titulo'];
            $pedido = $res[$i]['txt_mo'];
            $data = date('d/m/Y', strtotime($res[$i]['data']));
            $hora = date('H:i', strtotime($res[$i]['hora']));
            $status = $res[$i]['status'];
            $motivo = $res[$i]['motivo'] ?? 'Sem Informação';
            $versiculo = $res[$i]['versiculo'] ?? 'Sem Informação';
            $versiculo_txt = $res[$i]['versiculo_txt'];
            @$video1 = $res[$i]['link_video1'];
            @$video2 = $res[$i]['link_video2'];
            @$video3 = $res[$i]['link_video3'];

            $id_membro = $res[$i]['id_membro'];

            $sql_2 = $pdo->query("SELECT * FROM membro WHERE id_membro = '$id_membro'");
            $res_2 = $sql_2->fetchAll(PDO::FETCH_ASSOC);
            if (count($res_2) > 0) {
                $perfil = $res_2[0]['foto_mem'];
                $id_usuario = $res_2[0]['id_usuario'];
                $nome_mem = $res_2[0]['nome_mem'];
            }

            $sql_3 = $pdo->query("SELECT * FROM membro WHERE id_usuario = '$_SESSION[id]'");
            $res_3 = $sql_3->fetchAll(PDO::FETCH_ASSOC);
            if (count($res_3) > 0) {
                $id_membroLog = $res_3[0]['id_membro'];
            }

            switch ($status) {
                case '0 - Pedido Inativo':
                    $status_bg = 'bg-danger';
                    break;
                case '1 - Pedido Ativo':
                    $status_bg = 'bg-success';
                    break;
                case '2 - Pedido em Processo':
                    $status_bg = 'bg-warning';
                    break;
                case '3 - Pedido Atendido':
                    $status_bg = 'bg-primary';
                    break;
                case '4 - Pedido Cancelado':
                    $status_bg = 'bg-dark';
                    break;
            }
            ?>
            <div class="col-md-3">
                <div class="card" style="width: 28rem;">
                    <?php
                    if ($_SESSION['id'] != $id_usuario) {
                        $style_opcoes = 'd-none';
                    } else {
                        $style_opcoes = 'd-block';
                    }
                    ?>
                    <div class="d-flex flex-wrap flex-row justify-content-center p-3 <?php echo $style_opcoes ?>">
                        <div class="">
                            <a class="card-link" style="text-decoration: none;" title="Adicionar Pedido" data-bs-toggle="modal" data-bs-target="#PedidoModalCadas">
                                <i class="fa-solid fa-folder-plus"></i> Add
                            </a>
                        </div>
                        <div class="mx-3">
                            <a class="card-link" style="text-decoration: none; cursor: pointer;" title="Excluir" onclick="ExcluirPedido(<?php echo $id_mo ?>)">
                                <i class="fa-solid fa-trash"></i> Excluir
                            </a>
                        </div>
                        <div class="">
                            <a class="card-link" style="text-decoration: none; cursor: pointer" title="Editar Pedido" onclick="EditarPedidoModal(<?php echo $id_mo ?>)">
                                <i class="fa-solid fa-pencil"></i> Editar
                            </a>
                        </div>
                    </div>
                    <img src="imagens/<?php echo $perfil ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <?php
                        if ($titulo == 'Pedido Nº') {
                            $tituloPersonalizado = $titulo .= $id_mo;
                        } else {
                            $tituloPersonalizado = $titulo;
                        }
                        ?>
                        <h6><small><?php echo $nome_mem ?></small></h6>
                        <h5 class="card-title"><strong><?php echo $tituloPersonalizado ?></strong></h5>
                        <p class="card-text"><?php echo $pedido ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="d-flex flex-wrap justify-content-between">
                                <div>
                                    Data e Hora:
                                </div>
                                <div>
                                    <?php echo $data . ' - ' . $hora ?>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex flex-wrap justify-content-between">
                                <div>
                                    Versículo:
                                </div>
                                <div>
                                    <p class="text-primary" title="<?php echo $versiculo_txt ?>" onclick="$('#VersiculoTxtModal').modal('show'); $('#VersiculoTxtModal .modal-body').html('<p><?php echo $versiculo_txt ?>')">
                                        <?php echo $versiculo ?>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item <?php echo $status_bg ?>">
                            <div class="d-flex flex-wrap justify-content-between">
                                <div>
                                    Status:
                                </div>
                                <div>
                                    <?= $status ?>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex flex-wrap justify-content-between">
                                <div>
                                    Motivo:
                                </div>
                                <div>
                                    <?php echo $motivo ?>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item bg-dark">
                            <div class="d-flex flex-wrap justify-content-between">
                                <div>
                                    Vídeos:
                                </div>
                                <div data-bs-toggle="modal" data-bs-target="#VerVideos<?php echo $id_mo ?>">
                                    <?php echo $tot_videos ?> Vídeos de Ajuda
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="card-body d-block text-center">
                        <select name="status<?php echo $id_mo ?>" id="status<?php echo $id_mo ?>" class="form-select <?php echo $style_opcoes ?>" onchange="atualizarStatus(<?php echo $id_mo ?>)">
                            <option value="0 - Pedido Inativo">Atualize os Status</option>
                            <option value="0 - Pedido Inativo">0 - Pedido Inativo</option>
                            <option value="1 - Pedido Ativo">1 - Pedido Ativo</option>
                            <option value="2 - Pedido em Processo">2 - Pedido em Processo</option>
                            <option value="3 - Pedido Atendido">3 - Pedido Atendido</option>
                            <option value="4 - Pedido Cancelado">4 - Pedido Cancelado</option>
                        </select>
                        <div class="d-flex flex-wrap">
                            <?php
                            $sql_3 = $pdo->query("SELECT * FROM le_pedidos WHERE id_mo = '$id_mo' AND id_membro = '$id_membroLog'");
                            $res_3 = $sql_3->fetchAll(PDO::FETCH_ASSOC);
                            if (count($res_3) > 0) {
                            ?>
                                <button class="btn py-2 px-3" onclick="le(<?php echo $id_mo ?>, 'exc')" style="background-color: #370b5c; color: white; border-radius: 0px;">
                                    <i class="fa-solid fa-bookmark"></i>
                                </button>
                            <?php
                            } else {
                                ?>
                                <button class="btn py-2 px-3" onclick="le(<?php echo $id_mo ?>, 'add')" style="background-color: #370b5c; color: white; border-radius: 0px;">
                                    <i class="fa-regular fa-bookmark"></i>
                                </button>
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