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
    } section p {
        font-size: 50px;
    }
</style>
<section id="header">
    <h1>Ministério de Louvor</h1>
    <p><?php echo "\u{1F3B6}"?> <?php echo "\u{1F3B9}"?> <?php echo "\u{1F3BA}"?></p>
</section>
<section class="container py-5">
    <div>
        <h3>Integrantes do Ministério:</h3>
    </div>
    <div class="integrantes">

    </div>
</section>

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