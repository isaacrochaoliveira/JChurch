<?php
require('../../config/conect.php');
@session_start();

$id_mo = $_POST['id_mo'];

$sql = $pdo->query("SELECT * FROM minhas_oracoes WHERE id_mo = '$id_mo'");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0) {
    $titulo = $res[0]['titulo'];
    $pedido = $res[0]['txt_mo'];
    $data = date('d/m/Y', strtotime($res[0]['data']));
    $hora = date('H:i', strtotime($res[0]['hora']));
    $status = $res[0]['status'];
    $motivo = $res[0]['motivo'] ?? 'Sem Informação';
    $versiculo = $res[0]['versiculo'] ?? 'Sem Informação';
    $versiculo_txt = $res[0]['versiculo_txt'];
    $link_ajuda1 = $res[0]['link_video1'];
    $link_ajuda2 = $res[0]['link_video2'];
    $link_ajuda3 = $res[0]['link_video3'];
    $titulo_video1 = $res[0]['titulo_video1'];
    $titulo_video2 = $res[0]['titulo_video2'];
    $titulo_video3 = $res[0]['titulo_video3'];
?>
    <div class="modal-body-editar">
        <input type="text" class="d-none" value="<?php echo $id_mo ?>" id="id_mo">
        <div class="row">
            <div class="col-md-8">
                <?php
                if ($titulo == 'Pedido Nº') {
                    $tituloPersonalizado = $titulo .= $id_mo;
                } else {
                    $tituloPersonalizado = $titulo;
                }
                ?>
                <div class="d-flex">
                    <h4 class="tituloH3Personalizado<?php echo $id_mo ?>"><?php echo $tituloPersonalizado ?></h4>
                    <a class="ml-3" onclick="tituloPersonalizado(<?= $id_mo?>)"><i class="fa-solid fa-pencil"></i> </a>
                </div>
                <input type="text" class="d-none" id="tituloPersonalizado<?php echo $id_mo ?>" placeholder="Título Personalizado..." onkeyup="atualizarH3Titulo(<?php echo $id_mo ?>)">
            </div>
            <div class="col-md-4">
                <label for="">Data e Hora</label>
                <input type="text" class="form-control" id="id_mo" value="<?php echo $data . ' - ' . $hora ?>" readonly>
            </div>
        </div>
        <hr>
        <div class="row my-2">
            <div class="col-md-12">
                <label for="desc">Legenda:</label>
                <textarea class="form-control" id="desc" rows="3"><?php echo $pedido ?></textarea>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md-8">
                <label for="">Links de Ajuda:</label>
                <input type="text" class="form-control" id="link_ajuda1" placeholder="Link de Vídeo Externo..." value="<?php echo $link_ajuda1 ?>">
                <input type="text" class="form-control my-2" id="link_ajuda2" placeholder="Link de Vídeo Externo..." value="<?php echo $link_ajuda2 ?>">
                <input type="text" class="form-control" id="link_ajuda3" placeholder="Link de Vídeo Externo..." value="<?php echo $link_ajuda3 ?>">
            </div>
            <div class="col-md-4">
                <label for="">Título dos Vídeos</label>
                <input type="text" class="form-control" id="titulo_video1" placeholder="Título Personalidado..." value="<?php echo $titulo_video1 ?>">
                <input type="text" class="form-control my-2" id="titulo_video2" placeholder="Título Personalidado..." value="<?php echo $titulo_video2 ?>">
                <input type="text" class="form-control" id="titulo_video3" placeholder="Título Personalidado..." value="<?php echo $titulo_video3 ?>">
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md-4">
                <label for="">Versículo</label>
                <input type="text" class="form-control" id="referencia" value="<?php echo $versiculo ?>" placeholder="Livro Capitulo:Versículo">
            </div>
            <div class="col-md-8">
                <label for="">&nbsp;</label>
                <input type="text" class="form-control" id="versiculo_txt" value="<?php echo $versiculo_txt ?>" placeholder='"⁷ Se vós me conhecêsseis a mim, também conheceríeis a meu Pai; e já desde agora o conheceis, e o tendes visto."'>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md-12">
                <label for="">Motivo</label>
                <input type="text" class="form-control" id="motivo" value="<?php echo $motivo ?>" placeholder="Motivo do Pedido">
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            <button type="button" class="btn btn-danger w-25">Excluir</button>
            <button type="button" class="btn btn-primary w-25 mx-3" onclick="svlAlteracoes()">Salvar Alterações</button>
            <button type="button" class="btn btn-secondary w-25" data-bs-dismiss="modal">Fechar Janela</button>
        </div>
    </div>
<?php
} else {
    echo "Pedido não encontrado.";
    exit;
}
