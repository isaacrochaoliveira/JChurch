<?php
require_once('../index_php/protect.php');
require_once('../config/conect.php');
?>
<style>
    main {
        background: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, .5)), url('imagens/fundo_black.jpg') fixed;
        color: white;
    }
</style>
<main class="py-5">
    <section>
        <h1 class="text-center berkshire">Integrantes do Ministério:</h1>
        <div class="integrantes">

        </div>
    </section>
    <section class="d-flex flex-wrap ">
        <div class="col-dm-6 mx-auto text-center">
            <h2 class="f-60px">Alguma sugestão de música?</h2>
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
                    <label for="duracao_musica">Duração da Música</label>
                    <input type="text" name="duracao_musica" id="duracao_musica" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" value="Enviar Sugestão" class="btn btn-success py-3 px-5">
                </div>
            </form>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#PlayListModal">
                Músicas na Lista do Ministério <i class="fa-solid fa-music"></i>
            </button>
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
                    <div class="col-md-6 musicas-lista">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
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
                    alert(msg)
                }
            })
        });
    });
</script>