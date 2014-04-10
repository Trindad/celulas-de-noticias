<!-- Start: slider -->
<div class="slider">
  <div class="container-fluid">
    <div id="heroSlider" class="carousel slide">
      <div class="carousel-inner">

      <?php $count = 0; foreach ($ultimasNoticias as $noticia): ?>
        <div class="item <?php echo $count == 0 ? "active" : '' ?>">
          <div class="hero-unit">
            <div class="row-fluid">
              <div class="span7 marketting-info">
                <h1 class="titulo"><?php echo strtoupper($noticia->titulo) ?></h1>
                <p>
                  <?php echo trecho($noticia->texto,30);?>
                </p>
                <h3>
                  <a href="<?php echo ROOT. "noticia/{$noticia->id}" ?>" class="btn">Leia Mais</a>
                </h3>                      
              </div>
              <div class="span5">
                <?php
                  $imagem = DB::PegaInstancia()->query("SELECT * FROM noticia_imagem WHERE noticia_id = {$noticia->id} LIMIT 1")->fetch(PDO::FETCH_OBJ);
                  if ($imagem) {
                    echo "<img src=\"" . ROOT . "uploads/{$imagem->arquivo}\" alt=\"imagem\">";
                  }
                ?>
              </div>
            </div>                  
          </div>
        </div>
      <?php $count++; endforeach ?>

      </div>
      <a class="left carousel-control" href="#heroSlider" data-slide="prev">‹</a>
      <a class="right carousel-control" href="#heroSlider" data-slide="next">›</a>
    </div>
  </div>
</div>
<!-- End: slider -->
<!-- Start: PRODUCT LIST -->
  <div class="container">
    <div class="page-header">
      <h2>Confira as ultimas manchetes</h2>
    </div>
    <div class="row-fluid">
      <ul class="thumbnails">

        <?php $count = 0; foreach ($selecao_noticias as $noticia): ?> 
        <?php if ($count % 3 == 0): ?>
          </ul>
        </div>
        <div class="row-fluid">
          <ul class="thumbnails">
        <?php endif ?>
        <li class="span4">
          <div class="thumbnail">
            <?php
                  $imagem = DB::PegaInstancia()->query("SELECT * FROM noticia_imagem WHERE noticia_id = {$noticia->id} LIMIT 1")->fetch(PDO::FETCH_OBJ);
                  if ($imagem) {
                    echo "<img src=\"" . ROOT . "uploads/{$imagem->arquivo}\" alt=\"imagem\">";
                  }
                ?>
            <div class="caption">
              <h3><?php echo $noticia->titulo ?> </h3>
              <p>
                <?php echo trecho($noticia->texto,15) ?>
              </p>
            </div>
            <div class="widget-footer">
              <p>
                <a href="<?php echo ROOT. "noticia/{$noticia->id}" ?>" class="btn">Leia Mais</a>
              </p>
            </div>
          </div>
        </li>
        <?php $count++; endforeach ?>
      </ul>
    </div>
  </div>
<!-- End: PRODUCT LIST -->