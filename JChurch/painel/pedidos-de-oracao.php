<?php
require('../index_php/protect.php');
require_once('../config/conect.php');
@session_start();

date_default_timezone_set('America/Sao_Paulo');

$sql = $pdo->query("SELECT * FROM membro WHERE id_usuario = '$_SESSION[id]'");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
$id_membro = $res[0]['id_membro'];

?>
<div class="d-flex flex-wrap justify-content-center py-3">
    <div>
        <button class="btn btn-primary py-2 px-5" onclick="$('#PedidoModalCadas').modal('show')"><i class="fa-solid fa-folder-plus"></i> Pedido</button>
        <button class="btn btn-primary py-2 px-5"><i class="fa-solid fa-folder-plus"></i>Minha lista</button>
    </div>
</div>
<div class="oracoes">

</div>

<div class="modal fade" id="PedidoModalCadas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex flex-wrap flex-column">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modo de Criação</h1>
                    <label for="">Data e Hora de Criação:</label>
                    <input type="datetime" name="" id="" class="form-control" value="<?php echo date('d/m/y') ?> - <?php echo date('H:i', time()) ?>" readonly>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="legenda">Legenda</label>
                            <textarea name="legenda" id="legenda" cols="30" rows="7" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-outline-success" id="startOracao">Criar</button>
                        <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="LeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Orações Especiais </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Oração Adicionada as Especias! Você deseja ir para Orações Especias ou ficar nessa?
                    <p><strong>Em <i class="contagem_le">9</i> Segundos</strong> <i class="fa-solid fa-spinner fa-spin-pulse"></i></p>
                </p>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-outline-primary mx-3" onclick="location.href='pedidos-de-oracao/especiais.php'">Ir para Especiais</button>
                    <button type="button" class="btn btn-outline-secondary" onclick="location.reload()">Ficar Aqui</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="EditarPedidoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modo Edição</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="VersiculoTxtModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Versículo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var id_membro = "<?php echo $id_membro ?>";
        $.ajax({
            url: 'pedidos-de-oracao/oracoes.php',
            type: 'POST',
            data: {
                id_membro
            },
            success: function(data) {
                $('.oracoes').html(data);
            }
        });
    });
</script>

<script>
    function atualizarStatus(id_mo) {
        var status = $('#status' + id_mo).val();
        $.ajax({
            url: 'pedidos-de-oracao/atualizar-status.php',
            type: 'POST',
            data: {
                id_mo,
                status
            },
            success: function(data) {
                location.reload();
            }
        });
    }
</script>

<script>
    function EditarPedidoModal(id_mo) {
        $.ajax({
            url: 'pedidos-de-oracao/editar-pedido.php',
            type: 'POST',
            data: {
                id_mo
            },
            success: function(data) {
                $('#EditarPedidoModal .modal-body').html(data);
                $('#EditarPedidoModal').modal('show');
            }
        });
    }
</script>

<script>
    function svlAlteracoes() {
        var id_mo = $('#id_mo').val();
        var titulo = $('#tituloPersonalizado' + id_mo).val();
        var desc = $('#desc').val();
        var link_ajuda1 = $('#link_ajuda1').val();
        var link_ajuda2 = $('#link_ajuda2').val();
        var link_ajuda3 = $('#link_ajuda3').val();
        var titulo_video1 = $('#titulo_video1').val();
        var titulo_video2 = $('#titulo_video2').val();
        var titulo_video3 = $('#titulo_video3').val();
        var versiculo = $('#referencia').val();
        var versiculo_txt = $('#versiculo_txt').val();
        var motivo = $('#motivo').val();

        $.ajax({
            url: 'pedidos-de-oracao/atualizar-pedido.php',
            type: 'POST',
            data: {
                id_mo,
                titulo,
                desc,
                link_ajuda1,
                link_ajuda2,
                link_ajuda3,
                titulo_video1,
                titulo_video2,
                titulo_video3,
                versiculo,
                versiculo_txt,
                motivo
            },
            success: function(data) {
                location.reload();
            }
        });
    }
</script>

<script>
    function tituloPersonalizado(id_mo) {
        $('#tituloPersonalizado' + id_mo).removeClass('d-none');
        $('#tituloPersonalizado' + id_mo).addClass('d-block form-control');
        $('#tituloPersonalizado' + id_mo).focus();
    }
</script>

<script>
    function atualizarH3Titulo(id_mo) {
        var tituloPersonalizado = $('#tituloPersonalizado' + id_mo).val();
        $('.tituloH3Personalizado' + id_mo).html(tituloPersonalizado);
    }
</script>

<script>
    $(document).ready(function() {
        $("#startOracao").click(function() {
            var legenda = $('#legenda').val();
            $.ajax({
                url: 'pedidos-de-oracao/criarPedido.php',
                method: 'post',
                data: {
                    legenda
                },
                success: function(msg) {
                    if (msg.trim() == 'Oração Criada!') {
                        location.reload();
                    } else {
                        alert(msg);
                    }
                }
            })
        })
    })
</script>

<script>
    function ExcluirPedido(id_mo) {
        $.ajax({
            url: 'pedidos-de-oracao/excluir.php',
            method: 'post',
            data: {
                id_mo
            },
            success: function(msg) {
                location.reload();
            }
        })
    }
</script>

<script>
    function le(id_mo, acao = 'del') {
        if (acao === 'add') {
            $.ajax({
                url: 'pedidos-de-oracao/le_pedidos_add.php',
                method: 'post',
                data: {
                    id_mo
                },
                success: function(msg) {
                    $('#LeModal').modal('show');
                    FiveSeconds();
                }
            });
        } else {
            $.ajax({
                url: 'pedidos-de-oracao/le_pedidos_del.php',
                method: 'post',
                data: {
                    id_mo
                },
                success: function(msg) {
                    $('#LeModal').modal('show');
                    $('#LeModal .modal-body').html('Oração Removida das Especiais! Você deseja ir para a lista de pedidos ou ficar nessa? <p><strong>Em <i class="contagem_le">9</i> Segundos</strong> <i class="fa-solid fa-spinner fa-spin-pulse"></i></p>');
                    FiveSeconds();
                }
            });
        }
    }

    function FiveSeconds() {
        setTimeout(function() {
            $('.contagem_le').html(8);
            setTimeout(function() {
                $('.contagem_le').html(7);
                setTimeout(function() {
                    $('.contagem_le').html(6);
                    setTimeout(function() {
                        $('.contagem_le').html(5);
                        setTimeout(function() {
                            $('.contagem_le').html();
                            setTimeout(function() {
                                $('.contagem_le').html(4);
                                setTimeout(function() {
                                    $('.contagem_le').html(3);
                                    setTimeout(function() {
                                        $('.contagem_le').html(2);
                                        setTimeout(function() {
                                            $('.contagem_le').html(1);
                                            setTimeout(function() {
                                                $('#LeModal').modal('hide');
                                                location.reload();
                                            }, 1000);
                                        }, 1000);
                                    }, 1000);
                                }, 1000);
                            }, 1000);
                        }, 1000);
                    }, 1000);
                }, 1000);
            }, 1000);
        }, 1000);
    }
</script>