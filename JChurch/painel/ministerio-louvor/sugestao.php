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
                    $status_text = 'Pendente';
                } elseif ($status_sug == 'Aprovado') {
                    $status_sug = 'badge bg-success';
                    $status_text = 'Aprovado';
                } elseif ($status_sug == 'Analisando') {
                    $status_sug = 'badge bg-info';
                    $status_text = 'Analisando';
                } elseif ($status_sug == 'Rejeitado') {
                    $status_sug = 'badge bg-danger';
                    $status_text = 'Rejeitado';
                }
            ?>
                <tr>
                    <td><?php echo $titulo_musica; ?></td>
                    <td><?php echo $author_musica; ?></td>
                    <td><?php echo $ano; ?></td>
                    <td>
                        <span class="<?= $status_sug ?>"><?= $status_text ?></span>
                    </td>
                    <?php
                    if ($_SESSION['posto'] == 'Chefe dos Levitas') {
                        if ($status_text == 'Analisando') {
                    ?>
                            <td>
                                <button class='btn btn-success' onclick="aprovarSugestao(<?php echo $res[$i]['id_sug']; ?>)" title="Aprovar"><i class="fa-solid fa-square-check"></i></button>
                                <button class='btn btn-danger' onclick="rejeitarSugestao(<?php echo $res[$i]['id_sug']; ?>)" title="Rejeitar"><i class="fa-solid fa-circle-xmark"></i></button>
                            </td>
                        <?php
                        } else {
                            ?>
                            <td>
                                <button class='btn btn-primary' onclick="analisarSugestao(<?php echo $res[$i]['id_sug']; ?>)" title="Analisar"><i class="fa-solid fa-question"></i></button>
                            </td>
                        <?php
                        }
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
