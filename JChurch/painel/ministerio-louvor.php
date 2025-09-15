<?php
require_once('../index_php/protect.php');
require_once('../config/conect.php');
?>
<style>
    main {
        background: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, .5)), url('imagens/fundo_black.jpg') fixed;
        color: white;
    }

    #FormSuges input {
        width: 50%;
        text-align: center;
        margin: 0 auto;
    }
</style>
<main class="py-5">
    <section class="d-flex flex-wrap mb-5 justify-content-center align-items-center">
        <div class="col-md-6 text-center mb-4">
            <img src="imagens/concert-7460427_640.jpg" alt="Ministério de Louvor" class="img-fluid circular mb-3" style="width: 300px; height: 300px; object-fit: cover; border: 5px solid white; border-radius: 50%;">
            <div>
                <h5><u>LÍDER</u></h5>
                <h1 class="berkshire f-60px">Alice Monteiro</h1>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Integrantes do Ministério <i class="fa-solid fa-users"></i>
            </button>
            <a href="http://localhost/projects/JChurch/JChurch/painel/index.php?pag=publicacoes&id_membro=3">
                <button class="btn btn-outline-primary">
                    Visualizar Perfil <i class="fa-solid fa-user"></i>
                </button>
            </a>
        </div>
        <div class="col-md-6 text-center">
            <h2 class="f-40px">Alguma sugestão de música?</h2>
            <p>Coloque ela aqui, vamos analisar sua sugestão</p>
            <form method="post" class="mb-4" id="FormSuges">
                <div class="form-group">
                    <label for="nome_musica">Nome da Música</label>
                    <input type="text" name="nome_musica" id="nome_musica" class="form-control">
                </div>
                <div class="form-group">
                    <label for="author_musica">Autor da Música</label>
                    <input type="text" name="author_musica" id="author_musica" class="form-control">
                </div>
                <div class="form-group">
                    <label for="link_musica">Link da Música</label>
                    <input type="text" name="link_musica" id="link_musica" class="form-control">
                </div>
                <div class="form-group">
                    <label for="ano_lanc_sub">Ano de Lançamento</label>
                    <input type="text" name="ano_lanc_sub" id="ano_lanc_sub" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" value="Enviar Sugestão" class="btn btn-success py-3 px-5">
                </div>
            </form>
            <button type="button" class="btn btn-primary py-3 px-5" data-bs-toggle="modal" data-bs-target="#PlayListModal">
                Músicas na Lista do Ministério <i class="fa-solid fa-music"></i>
            </button>
            <?php
            if ($_SESSION['posto'] == 'Chefe dos Levitas') {
                echo "<button type='button' class='btn btn-outline-primary py-3 px-5' data-bs-toggle='modal' data-bs-target='#SugesModal'>
                Músicas na Lista de Sugestão <i class='fa-solid fa-music'></i>
            </button>";
            }
            ?>
        </div>
    </section>
    <div class="modal fade" id="PlayListModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Playlist</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 musicas-lista">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="SugesModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Playlist</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 sugestao-lista">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ministério de Louvor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h1 class="text-center berkshire f-60px">Integrantes do Ministério:</h1>
                    <div class="integrantes">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        $.ajax({
            url: 'ministerio-louvor/integrantes.php',
            method: 'post',
            data: {},
            success: function(msg) {
                $(".integrantes").html(msg);
            }
        })
    })
</script>

<script>
    $(document).ready(function() {
        $.ajax({
            url: 'ministerio-louvor/musicas.php',
            method: 'post',
            data: {},
            success: function(msg) {
                $('.musicas-lista').html(msg);
            }
        })
    });
</script>

<script>
    $(document).ready(function() {
        $.ajax({
            url: 'ministerio-louvor/sugestao.php',
            method: 'post',
            data: {},
            success: function(msg) {
                $('.sugestao-lista').html(msg);
            }
        })
    });
</script>

<script>
    $(document).ready(function() {
        $('#FormSuges').submit(function(event) {
            event.preventDefault();
            var data = new FormData(this);
            $.ajax({
                url: 'ministerio-louvor/inserir-sugestao.php',
                method: 'post',
                data: data,
                processData: false,
                contentType: false,
                success: function(msg) {
                    if (msg.trim() == 'Inserido com Sucesso!') {
                        location.reload();
                    } else {
                        alert(msg);
                    }
                }
            })
        });
    });
</script>

<script>
    function rejeitarSugestao(id) {
        let confirma = confirm("Tem certeza que deseja rejeitar essa sugestão?");
        if (confirma) {
            $.ajax({
                url: 'ministerio-louvor/rejeitar-sugestao.php',
                method: 'post',
                data: {
                    id_sug: id
                },
                success: function(msg) {
                    if (msg.trim() == 'Rejeitado com Sucesso!') {
                        location.reload();
                    } else {
                        alert(msg);
                    }
                }
            })
        }
    }
</script>

<script>
    function aprovarSugestao(id) {
        let confirma = confirm("Tem certeza que deseja aprovar essa sugestão?");
        if (confirma) {
            $.ajax({
                url: 'ministerio-louvor/aprovar-sugestao.php',
                method: 'post',
                data: {
                    id_sug: id
                },
                success: function(msg) {
                    if (msg.trim() == 'Aprovado com Sucesso!') {
                        location.reload();
                    } else {
                        alert(msg);
                    }
                }
            })
        }
    }
</script>

<script>
    function analisarSugestao(id) {
        let confirma = confirm("Tem certeza que deseja analisar essa sugestão?");
        if (confirma) {
            $.ajax({
                url: 'ministerio-louvor/analisar-sugestao.php',
                method: 'post',
                data: {
                    id_sug: id
                },
                success: function(msg) {
                    if (msg.trim() == 'Em Análise com Sucesso!') {
                        location.reload();
                    } else {
                        alert(msg);
                    }
                }
            })
        }
    }
</script>