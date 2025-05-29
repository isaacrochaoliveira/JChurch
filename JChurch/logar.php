<?php 
require("config/config.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=TITULO ?></title>
    <link rel="shorcut icon" type="image/png" href="favicon/crown.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/fonts.css">
    <link rel="stylesheet" href="styles/css.css">
</head>
<body>
<section id="secao_cadastro">
        <div class="flex">
            <div class="imgs w-50">
            </div>
            <div class="form w-50 bg-black" style="color: white">
                <div class="d-none" id="alert" role="alert">
                </div>
                <h4>
                    LOGIN
                </h4>
                <form>
                    <div class="form-group">
                        <label for="email">E-Mail</label>
                        <input type="email" placeholder="Seu Email" class="form-control email">
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" placeholder="Sua Senha" class="form-control senha">
                    </div>
                    <div>
                        <a href="#">
                            <button onclick="cad()" id="cad">
                                ENTRAR
                            </button>
                        </a>
                    </div>
                </form>
            </div>
            
        </div>
    </section>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#cad').click(function(e) {
            e.preventDefault();
            var email = $('.email').val();
            var senha = $('.senha').val();
            $.ajax({
                url: 'index_php/logar.php',
                method: 'post',
                data: {
                    email,
                    senha
                },
                dataType: 'text',
                success: function(msg) {
                    if (msg == 'Salvo com Sucesso!') {
                        window.location = 'painel/index.php';
                    } else {
                        $('#alert').removeClass();
                        $('#alert').addClass('alert alert-danger');
                        $('#alert').text(msg);
                    }
                }
            })
        })
    })
</script>

</html>