<?php 
    require("config/config.php");

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITULO ?></title>
    <link rel="shorcut icon" type="image/png" href="favicon/crown.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/fonts.css">
    <link rel="stylesheet" href="styles/css.css">
</head>

<body>
    <section id="secao_comeco">
        <h1 id="titulo">JChurch</h1>
        <h3 id="conteudo">Sistema para Igrejas</h3>
        <div>
            <button>
                <a href="logar.php">
                    LOGIN
                </a>
            </button>
            <button>
                <a href="cadastrar.php">
                    CADASTRAR
                </a>
            </button>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>