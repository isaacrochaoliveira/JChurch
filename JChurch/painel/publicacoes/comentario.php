<?php
require_once('../../config/conect.php');
@session_start();

date_default_timezone_set('America/Sao_Paulo');

$id_publi = $_POST['id_publi'];
$comentario = $_POST['comentario'] ?? null;
if (!isset($comentario)) {
    $sql = $pdo->query("SELECT * FROM publicacoes WHERE id_publi = '$id_publi'");
    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
    if (count($res) > 0) {
        for ($c = 0; $c < count($res); $c++) {
            $id_public = $res[$c]['id_publi'];
            $foto_p = $res[$c]['foto_p'];
            $descricao_p = $res[$c]['descricao_p'];
            $hashtag_p = $res[$c]['hashtag_p'];
            $data = $res[$c]['data'];
            $hora = $res[$c]['hora'];
            $id_membro = $res[$c]['id_membro'];

            $curtidas = $res[$c]['curtidas_p'];
            $dataF = implode('/', array_reverse(explode('-', $data)));
?>
            <div class="d-flex flex-wrap flex-column my-5">
                <h5 class="mb-0"><?php echo $dataF ?> - <?php echo $hora ?></h5>
                <img src="imagens/publis/<?php echo $foto_p ?>" alt="" width="800">
                <div class="my-3">
                    <h4>
                        <strong><?php echo $descricao_p ?></strong>
                    </h4>
                    <p class=""><?php echo $hashtag_p ?></p>
                </div>
            </div>
<?php
        }
    }
} else {
    $id_user = $_SESSION['id'];
    $data = date('Y-m-d');
    $hora = date('H:i', time());

    if ($comentario == "") {
        echo "Comentário não pode ser vazio!";
        exit();
    }

    $pdo->query("INSERT INTO comentario SET id_publi = '$id_publi', id_usuario = '$id_user', txt = '$comentario', data = '$data', hora = '$hora'");
    $pdo->query("UPDATE publicacoes SET comentarios_p = comentarios_p + 1 WHERE id_publi = '$id_publi'");

    echo "Comentário adicionado com sucesso!";
}
