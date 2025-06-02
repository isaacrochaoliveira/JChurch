<?php 
require_once('../index_php/protect.php');
require_once('../config/conect.php');
?>
<style>
    section#header {
        background: linear-gradient(rgba(0, 0, 0, .8), rgba(0, 0, 0, 0.8)), url('imagens/celebration.jpg') no-repeat;
        padding: 250px 150px;
        background-position: center;
        background-size: cover;
        text-align: center;
        color: white;
    } section h1 {
        border-bottom: 3px solid white;
    } section p.icons {
        font-size: 50px;
    }
    main {
        background: linear-gradient(rgba(0, 0, 0, .7), rgba(0, 0, 0, .7)), url('imagens/fundo_black.jpg');
        color: white;
    }
</style>
<section id="header">
    <h1>Ministério de Louvor</h1>
    <p class="icons"><?php echo "\u{1F3B6}"?> <?php echo "\u{1F3B9}"?> <?php echo "\u{1F3BA}"?></p>
</section>
<main class="py-5">
    <section>
        <h3 class="text-center berkshire">Integrantes do Ministério:</h3>
        <div class="integrantes">
    
        </div>
    </section>
    <section class="musicas-lista">

    </section>
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