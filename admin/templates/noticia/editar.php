<div class="page-header">
	<h1>Editar notícia</h1>
</div>

<form action="<?php echo ROOT ?>admin/forms.php" method="post" data-validate="parsley">
	<div class="control-group">
		<label for="">Título:</label>
		<input type="text" class="span12" name="titulo" required="required" value="<?php echo $noticia->titulo ?>" data-required="true" data-rangelength="[5,200]" />
	</div>

	<textarea name="texto" id="texto_noticia"><?php echo $noticia->texto ?></textarea>

	<br />

	<div class="control-group">
		<label for="">Categoria:</label>
		<?php echo Select("categoria",$categorias, $noticia->categoria); ?>
	</div>

	<div class="form-actions">
		<input type="hidden" name="acao" value="editar_noticia" />
		<input type="hidden" name="id" value="<?php echo $noticia->id ?>" />

		<button class="btn btn-primary" type="submit">Salvar Alterações</button>
		<a href="<?php echo ROOT ?>admin/noticias" class="btn">Cancelar</a>
	</div>
</form>