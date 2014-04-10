<div class="page-header">
  <h1>Notícias Recentes</h1>
</div>

<?php foreach ($noticias as $noticia): ?>
<div class="row bottom-space">
  <div class="span1 offset1">
    <div class="circle">
      <span class="event-date"><?php echo $mes[date("n", strtotime($noticia->data))] ?><br><?php echo  date("d", strtotime($noticia->data))?></span>
    </div>
  </div>
  <div class="span9">
    <h4><a href="<?php echo ROOT."noticia/{$noticia->id}" ?>"><?php echo $noticia->titulo ?></a></h4>
    <p>
      <?php echo trecho($noticia->texto,50) ?>
    </p>
  </div>
</div>
<?php endforeach ?>

<?php echo $paginacao ?>