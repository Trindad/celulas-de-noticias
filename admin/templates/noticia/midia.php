<legend>Enviar Mídia à Galeria da Notícia</legend>
<form method="post" action="<?php echo ROOT ?>admin/forms.php" enctype='multipart/form-data'>
	<div class="row-fluid">
		<div class="span6">
			<label>Imagem</label>
			<input type="file" name="img"/>
		</div>
		<div class="span6">
			<label>Vídeo(YouTube)</label>
			<input type="text" name="video"/>
		</div>

	</div>
	<div class="form-actions">
		<input type="hidden" name="acao" value="midia_noticia" />
		<input type="hidden" name="noticia_id" value="<?php echo $noticia->id ?>" />	

		<button class="btn btn-primary" type="submit">Enviar</button>
	</div>
</form>

<legend>Midias Enviadas</legend>
<div class="row-fluid">
	<?php foreach ($midias as $midia): ?>
		<div class="span3 midia">
			<?php if ($midia->tipo == 'video'): ?>
				<img src="http://img.youtube.com/vi/<?php echo $midia->arquivo ?>/hqdefault.jpg" alt="video">
			<?php else: ?>
				<img src="<?php echo ROOT ?>uploads/<?php echo $midia->arquivo ?>" alt="imagem">
			<?php endif ?>

			<a href="<?php echo ROOT ?>admin/noticias/deletar_midia/<?php echo $midia->id ?>/<?php echo $midia->tipo ?>" class='deleta-midia'>&times;</a>
		</div>
	<?php endforeach ?>
</div>

	
