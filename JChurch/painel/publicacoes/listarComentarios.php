<?php
require_once('../../config/conect.php');
@session_start();

$id_public = $_POST['id_publi'];
$id_user = $_SESSION['id'];

$sql = $pdo->query("SELECT * FROM comentario WHERE id_publi = '$id_public'");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0) {
    for ($c = 0; $c < count($res); $c++) {
        $id_comentario = $res[$c]['id_co'];
        $id_publi = $res[$c]['id_publi'];
        $id_usuario = $res[$c]['id_usuario'];
        $data = $res[$c]['data'];
        $hora = $res[$c]['hora'];
        $comentario = $res[$c]['txt'];


        $data = date('d/m/Y', strtotime($data));

        $sql_2 = $pdo->query("SELECT * FROM membro WHERE id_usuario = '$id_usuario'");
        $res_2 = $sql_2->fetchAll(PDO::FETCH_ASSOC);

        $sql_3 = $pdo->query("SELECT * FROM publicacoes WHERE id_publi = '$id_publi'");
        $res_3 = $sql_3->fetchAll(PDO::FETCH_ASSOC);
        $id_membro_author = $res_3[0]['id_membro'];

        if (count($res_2) > 0) {
            $id_membro = $res_2[0]['id_membro'];
            $nome_usuario = $res_2[0]['nome_mem'];
            $perfil = $res_2[0]['foto_mem'];

            if ($id_usuario == $id_membro_author) {
                $nome_usuario .= '<small> Author(a)</small>';
            }
?>
            <p>
                <img src="imagens/<?php echo $perfil ?>" alt="" width="50" height="50" class="rounded-circle">
                <a href="index.php?pag=publicacoes&id_membro=<?php echo $id_membro ?>" class="text-decoration-none">
                    <strong>
                        <?= $nome_usuario ?>
                    </strong>
                </a>
                -
                <small>
                    <?= $data ?> -
                    <?= $hora ?>
                </small>
            </p>
            <p><?= $comentario ?></p>
            <hr>
<?php
        }
    }
} else {
    echo "<p class='text-center'>Nenhum comentário encontrado.</p>";
}
