<?php
require_once('../../config/conect.php');

@session_start();

$sql = $pdo->query("SELECT * FROM sugestao_musicas;");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0) {
?>
    <table class="table table-dark table-striped-columns">
        <thead>
            <tr>
                <th scope="col">Título</th>
                <th scope="col">Author</th>
                <th scope="col">Ano de Lançamento</th>
                <th scope="col">Status</th>
                <?php 
                    if ($_SESSION['posto'] == 'Chefe dos Levitas') {
                        echo "<th scope='col'>Ações</th>";
                    }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($res); $i += 1) {
                $titulo_musica = $res[$i]['tituto_sug'];
                $author_musica = $res[$i]['author_sug'];
                $ano = $res[$i]['ano_lanc_sug'];
                $status_sug = $res[$i]['status'];
                if ($status_sug == 'Pendente') {
                    $status_sug = 'badge bg-warning';
                } elseif ($status_sug == 'Aprovado') {
                    $status_sug = 'badge bg-success';
                } else {
                    $status_sug = 'badge bg-danger';
                }
            ?>
                <tr>
                    <td><?php echo $titulo_musica; ?></td>
                    <td><?php echo $author_musica; ?></td>
                    <td><?php echo $ano; ?></td>
                    <td>
                        <span class="<?= $status_sug ?>">Pendente</span>
                    </td>
                    <?php
                    if ($_SESSION['posto'] == 'Chefe dos Levitas') {
                        ?>
                        <td>
                            <button class='btn btn-success' title="Aprovar"><i class="fa-solid fa-square-check"></i></button>
                            <button class='btn btn-danger' onclick="rejeitarSugestao(<?php echo $res[$i]['id_sug']; ?>)" title="Rejeitar"><i class="fa-solid fa-circle-xmark"></i></button>
                            <button class='btn btn-primary' title="Analisar"><i class="fa-solid fa-question"></i></button>
                        </td>
                        <?php
                    }
                    ?>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
}
