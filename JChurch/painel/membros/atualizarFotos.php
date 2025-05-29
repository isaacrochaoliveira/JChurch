<?php 
require_once('../../config/conect.php');
@session_start();


//SCRIPT PARA SUBIR FOTO NO BANCO
$banner = preg_replace('/[ -]+/', '-', @$_FILES['banner']['name']);
$foto = preg_replace('/[ -]+/', '-', @$_FILES['foto']['name']);

$caminhoBanner = '../imagens/banners/' . $banner;
$caminhoFoto = '../imagens/' . $foto;

$bannerTemp = @$_FILES['banner']['tmp_name'];
$fotoTemp = @$_FILES['foto']['tmp_name'];

if ($_FILES['banner']['name'] == ""){
    $sql = $pdo->query("SELECT banner FROM membro WHERE id_usuario = '$_SESSION[id]'");
    $res_2 = $sql->fetchAll(PDO::FETCH_ASSOC);
    if (count($res_2) > 0) {
        $fotobanner = $res_2[0]['banner'];
    }
}else{
    $fotobanner = $banner;
    $res_2[0]['banner'] = "";
}

if ($_FILES['foto']['name'] == ""){
    $sql = $pdo->query("SELECT foto_mem FROM membro WHERE id_usuario = '$_SESSION[id]'");
    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
    if (count($res) > 0) {
        $fotoFoto = $res[0]['foto_mem'];
    }
}else{
    $fotoFoto = $foto;
    $res[0]['foto_mem'] = "";
}

if ($fotobanner != $res_2[0]['banner']) {
    $BannerExt = pathinfo($banner, PATHINFO_EXTENSION);
    if (($BannerExt == 'webp') or ($BannerExt == 'jpg') or ($BannerExt == 'jpeg')) {
        move_uploaded_file($bannerTemp, $caminhoBanner);
    } else {
        echo 'Extensão de Imagem não permitida!';
        exit();
    }
}

if (!($fotoFoto == $res[0]['foto_mem'])) {
    $FotoExt = pathinfo($foto, PATHINFO_EXTENSION);
    if ($FotoExt == 'webp' or $FotoExt == 'jpg' or $FotoExt == 'jpeg') {
        move_uploaded_file($fotoTemp, $caminhoFoto);
    } else {
        echo 'Extensão de Imagem não permitida!';
        exit();
    }
}

if ($fotobanner != "") {
    $sql = $pdo->prepare("UPDATE membro SET banner = :banner WHERE id_usuario = :id");
    $sql->bindValue(':banner', $fotobanner);
    $sql->bindValue(':id', $_SESSION['id']);
    $sql->execute();
} 

if ($fotoFoto != "") {
    $sql = $pdo->prepare("UPDATE membro SET foto_mem = :foto WHERE id_usuario = :id");
    $sql->bindValue(':foto', $fotoFoto);
    $sql->bindValue(':id', $_SESSION['id']);
    $sql->execute();
}

if ($sql) {
    echo "Foto Atualizada com Sucesso!')";
} else {
    echo "Erro ao atualizar a foto!')";
}
