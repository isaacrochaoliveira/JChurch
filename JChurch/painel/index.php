<?php
require('../index_php/protect.php');
require('../config/conect.php');
@session_start();
$pag = @$_GET['pag'];

$pag1 = 'membros';
$pag2 = 'editar-perfil';
$pag3 = 'publicacoes';
$pag4 = 'pedidos-de-oracao';
$pag5 = 'pedidos-salvos';
$pag6 = 'ministerio-louvor';

$sql = $pdo->query("SELECT * FROM membro WHERE id_usuario = '$_SESSION[id]'");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
$id_membro = $res[0]['id_membro'];

?>
<!DOCTYPE html>
<html lang="pt-br">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo TITULO ?></title>
<link rel="shorcut icon" type="image/png" href="../favicon/crown.png">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
<link rel="stylesheet" href="../styles/fonts.css">
<link rel="stylesheet" href="../styles/css.css">
<link rel="stylesheet" href="css/css.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</head>

<body>
    <header class="d-flex flex-wrap justify-content-evenly py-4 mb-4 border-bottom bg-dark">
        <div>
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img src="../favicon/crown.png" width="40" height="32" aria-hidden="true"></img>
                </a>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="index.php" class="nav-link px-2 text-secondary">Home</a></li>
                    <li><a href="index.php?pag=<?= $pag4 ?>" class="nav-link px-2 text-white">Pedidos de Oração</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Escala de Obreiros</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Reuniões</a></li>
                    <div class="btn-group">
                        <a class="nav-link px-2 text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Mais
                        </a>
                        <ul class="dropdown-menu bg-dark" style="width: 250px;">
                            <li>
                                <a href="index.php?pag=<?php echo $pag6?>" class="nav-link px-2 text-white">Ministério de Louvor</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-2 text-white">Grupos de Irmãs</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-2 text-white">Grupo de Irmãs</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-2 text-white">Grupo de Irmãos</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-2 text-white">Grupo de Jovens</a>
                            </li>
                            <li>
                                <a href="index.php?pag=<?= $pag1 ?>" class="nav-link px-2 text-white">Membros</a>
                            </li>
                            <li>
                                <a class="nav-link nav-link px-2 text-white" href="#">Atividades e Comunhão</a>
                            </li>
                            <li>
                                <a class="nav-link nav-link px-2 text-white" href="#">Leitura da Palavra</a>
                            </li>
                            <li>
                                <a class="nav-link nav-link px-2 text-white" href="#">Jejuns</a>
                            </li>
                        </ul>
                    </div>

                </ul>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
                </form>
                <div class="text-end">
                    <!-- <button type="button" class="btn btn-outline-light me-2">Login</button> -->
                    <a href="../index_php/exit.php" type="button" class="btn btn-outline-danger">Sair</a>
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center mt-3">
                <?php
                $sql = $pdo->query("SELECT * FROM membro WHERE id_usuario = '$_SESSION[id]'");
                $res = $sql->fetchAll(PDO::FETCH_ASSOC);
                $perfil = $res[0]['foto_mem'];
                $nome = $res[0]['nome_mem'];
                $cargo = $res[0]['cargo_mem'];
                ?>
                <div class="col-md-1">
                    <img src="imagens/<?php echo $perfil ?>" alt="" width="65">
                </div>
                <div class="col-md-11 my-auto">
                    <strong>
                        <a href="index.php?pag=publicacoes&id_membro=<?php echo $id_membro ?>">
                            <h6><?= $nome ?></h6>
                            <h6><?php echo $cargo?></h6>
                        </a>
                    </strong>
                </div>
            </div>
        </div>
    </header>
    <?php
    if (@$pag == $pag1) {
        @include_once($pag1 . '.php');
    } else if (@$pag == $pag2) {
        @include_once($pag2 . '.php');
    } else if (@$pag == $pag3) {
        @include_once($pag3 . '.php');
    } else if (@$pag == $pag4) {
        @include_once($pag4 . '.php');
    } else if (@$pag == $pag5) {
        @include_once($pag5 . '.php');
    } else if (@$pag == $pag6) {
        @include_once($pag6 . '.php');
    } else {
    ?>
        <section>
            <div class="d-flex flex-wrap justify-content-evenly">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Mês Referente a EO</h3>
                    </div>
                    <div class="card-body">
                        Maio
                    </div>
                    <div class="card-footer bg-primary">
                        <a href="" class="d-flex flex-wrap justify-content-between">
                            Mais de 300 escalas disponíveis
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Música para o Minitério de Louvor</h3>
                    </div>
                    <div class="card-body">
                        23 Músicas
                    </div>
                    <div class="card-footer bg-primary">
                        <a href="" class="d-flex flex-wrap justify-content-between">
                            Ver todas as Músicas
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aniversariantes do Mês</h3>
                    </div>
                    <div class="card-body">
                        8 Pessoas
                    </div>
                    <div class="card-footer bg-primary">
                        <a href="" class="d-flex flex-wrap justify-content-between">
                            Veja Quais
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Atividades para Este Mês</h3>
                    </div>
                    <div class="card-body">
                        4 Atividades
                    </div>
                    <div class="card-footer bg-primary">
                        <a href="" class="d-flex flex-wrap justify-content-between">
                            Ver Todas as atividades
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
        </section>
    <?php
    }
    ?>




</body>

</html>