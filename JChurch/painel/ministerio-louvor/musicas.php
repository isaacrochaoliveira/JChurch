<?php
require_once('../../config/conect.php');

@session_start();

$sql = $pdo->query("SELECT * FROM musicas_ministerio;");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0) {
?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Músicas do Ministério de Louvor</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive p-0" style="height: 300px;">
            <table class="table table-head-fixed text-nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Música</th>
                        <th>Author</th>
                        <th>Minutagem</th>
                    </tr>
                </thead>
                <?php
                for ($i = 0; $i < count($res); $i += 1) {
                    $id_musica = $res[$i]['id_musica'];

                    $titulo_musica = $res[$i]['titulo_musica'];
                    $author_musica = $res[$i]['author_musica'];
                    $minutagem_musica = $res[$i]['duracao_musica'];

                ?>

                    <tbody>
                        <tr>
                            <td><?= $id_musica ?></td>
                            <td><?= $titulo_musica ?></td>
                            <td><?= $author_musica ?></td>
                            <td><?= $minutagem_musica ?></td>
                        </tr>
                    </tbody>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
<?php
}
?>