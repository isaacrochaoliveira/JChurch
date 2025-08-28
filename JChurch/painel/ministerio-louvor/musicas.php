<?php
require_once('../../config/conect.php');

@session_start();

$sql = $pdo->query("SELECT * FROM musicas_ministerio;");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0) {
?>
    <table class="table table-dark table-striped-columns" style="width: 750px;">
        <thead>
            <tr>
                <th scope="col">Título</th>
                <th scope="col">Author</th>
                <th scope="col">Duração</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($res); $i += 1) {
                $titulo_musica = $res[$i]['titulo_musica'];
                $author_musica = $res[$i]['author_musica'];
                $minutagem_musica = $res[$i]['duracao_musica'];
            ?>
                <tr>
                    <td><?php echo $titulo_musica; ?></td>
                    <td><?php echo $author_musica; ?></td>
                    <td><?php echo $minutagem_musica; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
}
