<h2><?php echo $noticia->titulo ?></h2>
<div class='conteudo'>
	<?php echo $noticia->texto ?>
</div>
<legend>Galeria</legend>
<div class="row-fluid">
	<?php foreach ($midias as $midia): ?>
		<div class="span3 midia">
			<?php if ($midia->tipo == 'video'): ?>
				<iframe height="230" src="//www.youtube.com/embed/<?php echo $midia->arquivo ?>" frameborder="0" allowfullscreen></iframe>
			<?php else: ?>
				<a href="<?php echo ROOT ?>uploads/<?php echo $midia->arquivo ?>" rel='lightbox'>
					<img height="230" src="<?php echo ROOT ?>uploads/<?php echo $midia->arquivo ?>" alt="imagem">
				</a>
			<?php endif ?>
		</div>
	<?php endforeach ?>
</div>

<br /><br />

<div id="disqus_thread"></div>
<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>