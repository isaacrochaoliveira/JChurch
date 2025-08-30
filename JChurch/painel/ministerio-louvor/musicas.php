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
                $titulo_musica = $res[$i]['titulo_musica'];
                $author_musica = $res[$i]['author_musica'];
            ?>
                <tr>
                    <td><?php echo $titulo_musica; ?></td>
                    <td><?php echo $author_musica; ?></td>
                    <td>
                        <?php
                        if ($_SESSION['posto'] == 'Chefe dos Levitas') {
                            echo "<button class='btn btn-danger' onclick='deletarMusica(" . $res[$i]['id_musica'] . ")'>Deletar</button>";
                        }
                        ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
} else {
    echo "<p>Não há dados para mostrar</p>";
}
