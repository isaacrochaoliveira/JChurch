<?php 
require_once('../../config/conect.php');

$sql = $pdo->query("SELECT * FROM usuarios WHERE posto = 'Levita'");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0) {
    ?>
    <div class="row">
        <?php 
            for ($i = 0; $i < count($res); $i++) {
                $id_usuario = $res[$i]['id_usuario'];
                $posto = $res[$i]['posto'];
                
                $sql_2 = $pdo->query("SELECT * FROM membro WHERE id_usuario = '$id_usuario'");
                $res_2 = $sql_2->fetchAll(PDO::FETCH_ASSOC);
                $foto_mem = $res_2[0]['foto_mem'];
                $nome_mem = $res_2[0]['nome_mem'];
                $cargo_mem = $res_2[0]['cargo_mem'];
                ?>
                <div class="d-flex flex-wrap py-5">
                    <div class="w-50">
                        <div class="text-center">
                            <img src="./imagens/<?php echo $foto_mem ?>" alt="Foto de Perfil" width="380">
                            <hr>
                            <p>
                                <?php 
                                    echo $nome_mem . "<br>" . $posto . "<br>" . $cargo_mem;
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="w-50">
                        Olá
                    </div>
                </div>
                <?php
            }      
        ?>
    </div>
    <?php
}
?>