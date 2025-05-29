<?php
require_once('../config/conect.php');
date_default_timezone_set('America/Sao_Paulo');
@session_start();

$id_mem = addslashes($_GET['id_membro']);

$total_curtidas = 0;
$total_comentarios = 0;

$publis = $pdo->query("SELECT * FROM publicacoes WHERE id_membro = '$id_mem' ORDER BY id_publi DESC");
$res_publis = $publis->fetchAll(PDO::FETCH_ASSOC);
if (count($res_publis) > 0) {
    for ($o = 0; $o < count($res_publis); $o++) {
        $total_curtidas += (int) $res_publis[$o]['curtidas_p'];
        $total_comentarios += (int) $res_publis[$o]['comentarios_p'];
    }
}

$sql = $pdo->query("SELECT * FROM membro WHERE id_membro = '$id_mem'");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0) {


    $banner = $res[0]['banner'];
    $foto = $res[0]['foto_mem'];
    $nome_membro = $res[0]['nome_mem'];

    $data_nasc = $res[0]["nasc_mem"];
    $sexo = $res[0]["sexo_mem"];
    $cargo = $res[0]["cargo_mem"];
    $emprego = $res[0]["emprego_mem"];
    $telefone = $res[0]["telefone_mem"];
    $endereco = $res[0]["endereco"];
    $id_usuario = $res[0]["id_usuario"];

    $nome_membro = explode(' ', $nome_membro);
    $nome = $nome_membro[0];
    $sobrenome = $nome_membro[1];

    $idade = Date('Y') - explode('-', $data_nasc)[0];


    $sql_2 = $pdo->query("SELECT * FROM usuarios WHERE id_usuario = '$id_usuario'");
    $res_2 = $sql_2->fetchAll(PDO::FETCH_ASSOC);
    if (count($res_2) > 0) {
        $posto = $res_2[0]['posto'];
    } else {
        $posto = 'Não Definido';
    }
}
?>
<style>
    .layout {
        background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.1)), url('imagens/back_perfil.jpg') no-repeat;
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
        padding: 200px 0px;
        display: flex;
        align-items: center;
        justify-content: center;
    } .layout .sessao-perfil {
        background: linear-gradient(rgba(255, 255, 255, 0.12), rgba(255, 255, 255, 0.12));
        padding: 80px 10px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        color: white
    } .b-add-publi {
        background:rgba(255, 255, 255, 0.4);
    }
</style>

<section class="layout">
    <section class="sessao-perfil">
        <div class="d-flex flex-wrap justify-content-around">
            <div class="w-25">
                <div>
                    <img src="imagens/<?= $foto ?>" alt="Foto de Perfil" class="img-fluid rounded-circle" style="width: 100%;">
                </div>
                <div>
                    <h4>
                        <strong><?= $nome ?></strong>
                        <p style="font-size: 15px"><?= $sobrenome ?></p>
                    </h4>
                    <p><?php echo $idade . ' Anos ' ?></p>
                    <p><?php echo $cargo ?></p>
                    <p><?php echo $posto ?></p>
                    <p><?php echo $emprego ?></p>
                </div>
            </div>
            <div class="w-75">
                <div class="mb-5">
                    <div class="d-flex flex-wrap justify-content-around">
                        <div class="d-block text-center">
                            <h4><strong><?php echo count($res_publis) ?></strong></h4>
                            <h5>Publicações:</h5>
                        </div>
                        <div class="d-block text-center">
                            <h4><strong><?php echo $total_curtidas ?></strong></h4>
                            <h5>Curtidas</h5>
                        </div>
                        <div class="d-block text-center">
                            <h4><strong><?php echo $total_comentarios ?></strong></h4>
                            <h5>comentários</h5>
                        </div>
                        <?php 
                            if ($_SESSION['id'] == $id_usuario) {
                                ?>
                                    <button type="button" class="b-add-publi px-5 py-1" data-bs-toggle="modal" data-bs-target="#criarPublicacao"><i class="fa-solid fa-plus"></i></button>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-evenly">
                    <?php
                    $sql = $pdo->query("SELECT * FROM publicacoes WHERE id_membro = '$id_mem' ORDER BY id_publi DESC");
                    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
                    if (count($res) > 0) {
                        for ($c = 0; $c < count($res); $c++) {
                            $id_public = $res[$c]['id_publi'];
                            $foto_p = $res[$c]['foto_p'];
                            $descricao_p = $res[$c]['descricao_p'];
                            $hashtag_p = $res[$c]['hashtag_p'];
                            $data = $res[$c]['data'];
                            $hora = $res[$c]['hora'];
                            $id_membro = $res[$c]['id_membro'];

                            $curtidas = $res[$c]['curtidas_p'];

                            $dataF = implode('/', array_reverse(explode('-', $data)));

                            $sql_2 = $pdo->query("SELECT * FROM curtidas WHERE id_publi = '$id_public' AND id_usuario = '$_SESSION[id]'");
                            $res_2 = $sql_2->fetchAll(PDO::FETCH_ASSOC);
                            if (count($res_2) > 0) {
                                $display_curtida = 'd-none';
                                $display_descurtida = 'd-block';
                            } else {
                                $display_curtida = 'd-block';
                                $display_descurtida = 'd-none';
                            }

                            $sql_3 = $pdo->query("SELECT * FROM comentario WHERE id_publi = '$id_public'");
                            $res_3 = $sql_3->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                            <div class="d-flex flex-wrap flex-column">
                                <p class="mb-0"><?php echo $dataF ?> - <?php echo $hora ?></p>
                                <img src="imagens/publis/<?php echo $foto_p ?>" alt="" width="400">
                                <div>
                                    <p class="mb-0 mt-2 f-18px"><strong><?php echo $descricao_p ?></strong></p>
                                    <p class=""><?php echo $hashtag_p ?></p>
                                </div>
                                <div class="d-flex">
                                    <a class="display-descurtida<?= $id_public ?> <?php echo $display_descurtida ?>" onclick="curtida(<?php echo $id_public ?>, 'unlike')">
                                        <p class="mx-2 text-danger texto-curtida<?= $id_public ?>" style="font-size: 24px;"><i class="fa-solid fa-heart"></i></p>
                                    </a>
                                    <a class="display-curtida<?= $id_public ?> <?php echo $display_curtida ?>" onclick="curtida(<?php echo $id_public ?>, 'like')">
                                        <p class="mx-2 text-secondary texto-curtida<?= $id_public ?>" style="font-size: 24px;"><i class="fa-solid fa-heart"></i></p>
                                    </a>
                                    <p class="ncurtida<?= $id_public ?>"><?= $curtidas ?></p>
                                    <a class="comentario" onclick="mostrarPubliComent(<?php echo $id_public ?>)">
                                        <div class="d-flex flex-wrap flex-row">
                                            <p class="mx-2" style="font-size: 24px;"><i class="fa-solid fa-comment-dots"></i></p>
                                        </div>
                                    </a>
                                    <p><?php echo count($res_3) ?></p>
                                    <p></p>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p class='text-center'>Nenhuma publicação encontrada.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</section>

<div class="modal fade" id="criarPublicacao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex flex-wrap flex-column">
                    <h5>Adicione a foto para ser publicada</h5>
                    <forM enctype="multipart/form-data" id="FormFotoP">
                        <input type="file" name="foto_p" id="foto_p" class="form-control" onchange="carregarImg('#foto_p', 'mostrarFotoP')">
                        <input type="submit" value="" id="btnFotoP" class="d-none">
                    </forM>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h3><strong>Nova Publicação de <?php echo $nome ?></strong></h3>
                        <hr>
                        <p>Data de Criação: <?php echo Date('d/m/Y') ?></p>
                        <p>Hora da Criação: <?php echo Date('H:i:s', time()) ?></p>
                        <p id="nomeFotoP"></p>
                        <img src="" alt="" id="mostrarFotoP" width="270">
                    </div>
                    <div class="col-md-6">
                        <div>
                            <h3><strong>Informações sobre o Post</strong></h3>
                        </div>
                        <hr>
                        <div>
                            <form id="formPublicacao" enctype="multipart/form-data">
                                <div class="d-flex flex-wrap flex-column">
                                    <div class="form-group">
                                        <textarea name="descricaoP" id="descricaoP" placeholder="Descrição..." class="form-control" rows="6"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="hashtags" id="hashtags" class="form-control" placeholder="Hashtags">
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-arrow-up-from-bracket"></i> Subir</button>
                                    <input type="hidden" name="idP" id="idP" value="">
                                </div>
                            </form>
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

<div class="modal fade" id="comentarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex flex-wrap flex-row">
                    <div class="w-50">
                        <h3><strong>Comentários</strong></h3>
                        <hr>
                        <div class="d-flex flex-wrap flex-column">
                            <div class="form-group">
                                <textarea name="comentarioTXT" id="comentarioTXT" placeholder="..." class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success btn-comentar">
                            <i class="fa-solid fa-comment-dots"></i>
                            Ok
                        </button>
                        <div class="publica-Comentario">

                        </div>
                    </div>
                    <div class="w-50">
                        <div class="container my-3">
                            <h3><strong>Lista de Comentários</strong></h3>
                            <hr>
                            <div class="listar-Comentarios"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="text" name="id_publi" id="id_publi" val="" class="d-none">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#FormFotoP').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: 'membros/uploadP.php',
                method: 'POST',
                data: formData,
                success: function(msg) {
                    var dados = msg.split('###');
                    if (dados[0] == "Foto Atualizada com Sucesso!") {
                        $('#idP').val(dados[1]);
                        $('#descricaoP').focus();
                    } else {
                        alert(dados[0]);
                    }
                },
                cache: false,
                contentType: false,
                processData: false,
                xhr: function() { // Custom XMLHttpRequest
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                        myXhr.upload.addEventListener('progress', function() {
                            /* faz alguma coisa durante o progresso do upload */
                        }, false);
                    }
                    return myXhr;
                }
            })
        })
    })
</script>


<script type="text/javascript">
    function carregarImg(id, dest) {
        var target = document.getElementById(dest);
        var file = document.querySelector(id).files[0];
        var reader = new FileReader();
        $('#nomeFotoP').text(file.name + ' / ' + file.size / 1000 + ' KB');
        $('#NomeDaP').val(file.name);

        reader.onloadend = function() {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            target.src = "";
        }

        $("#btnFotoP").click();

    }
</script>

<script>
    $(document).ready(function() {
        $('#formPublicacao').submit(function(e) {
            e.preventDefault();
            var descricaoP = $('#descricaoP').val();
            var hashtags = $('#hashtags').val();
            var idP = $('#idP').val();
            $.ajax({
                url: 'membros/publicacoes.php',
                method: 'POST',
                data: {
                    descricaoP,
                    hashtags,
                    idP
                },
                success: function(msg) {
                    if (msg == "Publicação Atualizada com Sucesso!") {
                        $('#criarPublicacao').modal('hide');
                    } else {
                        alert(msg);
                    }
                }
            })
        })
    })
</script>

<script>
    function curtida(id_public, action) {
        $.ajax({
            url: 'publicacoes/curtida.php',
            method: 'POST',
            data: {
                id_public,
                action
            },
            success: function(msg) {
                if (action == 'like') {
                    $('.display-curtida' + id_public).addClass('d-none');
                    $('.display-descurtida' + id_public).removeClass('d-none');
                    $('.ncurtida' + id_public).text(msg);
                } else {
                    $('.display-descurtida' + id_public).addClass('d-none');
                    $('.display-curtida' + id_public).removeClass('d-none');
                    $('.ncurtida' + id_public).text(msg);
                }
            }
        })
    }
</script>

<script>
    $(document).ready(function() {
        $('.btn-comentar').click(function() {
            var comentario = $('#comentarioTXT').val();
            var id_publi = $('#id_publi').val();
            $.ajax({
                url: 'publicacoes/comentario.php',
                method: 'POST',
                data: {
                    comentario,
                    id_publi
                },
                success: function(msg) {
                    listarComentarios(id_publi);
                }
            })
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('#comentarioTXT').keypress(function(e) {
            if (e.which == 13) {
                e.preventDefault();
                $('.btn-comentar').click();
            }
        })
    })
</script>

<script>
    $(document).ready(function() {
        var id_publi = $('#id_publi').val();
        listarComentarios(id_publi);
    })
</script>


<script>
    function listarComentarios(id_publi) {
        $.ajax({
            url: 'publicacoes/listarComentarios.php',
            method: 'POST',
            data: {
                id_publi
            },
            dataType: 'html',
            success: function(msg) {
                $('.listar-Comentarios').html(msg);
            }
        })
    }
</script>

<script>
    function mostrarPubliComent(id_publi) {
        $.ajax({
            url: 'publicacoes/comentario.php',
            method: 'POST',
            data: {
                id_publi
            },
            success: function(msg) {
                $('.publica-Comentario').html(msg);
                listarComentarios(id_publi);
            }
        })
        $('#id_publi').val(id_publi);
        $('#comentarioModal').modal('show');
        $('#comentarioTXT').focus();
    }
</script>