<?php

require_once('../../config/conect.php');

$id_mo = $_POST['id_mo'];

$sql = $pdo->query("SELECT * FROM minhas_oracoes WHERE id_mo = '$id_mo'");
$res = $sql->fetchAll(PDO::FETCH_ASSOC);
if (count($res) > 0) {
    for ($i = 0; $i < count($res); $i++) {
        if (($res[$i]['link_video1'] <> '') || ($res[$i]['link_video2'] <> '') || ($res[$i]['link_video3'] <> '')) {
            @$video1 = $res[$i]['link_video1'];
            @$video2 = $res[$i]['link_video2'];
            @$video3 = $res[$i]['link_video3'];
        
            @$titulo1 = $res[$i]['titulo_video1'];
            @$titulo2 = $res[$i]['titulo_video2'];
            @$titulo3 = $res[$i]['titulo_video3'];
        
            @$link1 = explode('watch?v=', $video1);
            @$video1_embed = $link1[0] . 'embed/' . $link1[1];
            
            @$link2 = explode('watch?v=', $video2);
            @$video2_embed = $link2[0] . 'embed/' . $link2[1];
        
            @$link3 = explode('watch?v=', $video3);
            @$video3_embed = $link3[0] . 'embed/' . $link3[1];
        
            ?>
            <div class="bg-dark">
                <div id="carouselExampleCaptions" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <iframe width="1280" height="650"
                                src="<?php echo $video1_embed ?>"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
                            </iframe>
                            <div class="carousel-caption d-none d-md-block" style="background: linear-gradient(to left, rgb(255, 255, 255), rgba(179, 179, 179, 0.8)); color: black">
                                <h5><?php echo $titulo1?></h5>
                                <a href="<?php echo $video1 ?>" target="_blank"><?php echo $video1 ?></a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <iframe width="1280" height="650"
                                src="<?php echo $video2_embed ?>"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
                            </iframe>
                            <div class="carousel-caption d-none d-md-block" style="background: linear-gradient(to left, rgb(255, 255, 255), rgba(179, 179, 179, 0.8)); color: black">
                                <h5><?php echo $titulo2 ?></h5>
                                <a href="<?php echo $video2 ?>" target="_blank"><?php echo $video2 ?></a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <iframe width="1280" height="650"
                                src="<?php echo $video3_embed ?>"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
                            </iframe>
                            <div class="carousel-caption d-none d-md-block" style="background: linear-gradient(to left, rgb(255, 255, 255), rgba(179, 179, 179, 0.8)); color: black">
                                <h5><?php echo $titulo3 ?></h5>
                                <a href="<?php echo $video3 ?>" target="_blank"><?php echo $video3 ?></a>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        
        <?php
        } else {
            echo "<h3>Vídeos Nâo Incluídos ou não Encontrados!";
        }
    }
}
