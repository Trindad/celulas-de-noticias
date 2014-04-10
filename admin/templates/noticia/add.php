<div class="page-header">
	<h1>Adicionar notícia</h1>
</div>

<form action="<?php echo ROOT ?>admin/forms.php" method="post"  data-validate="parsley">
	<div class="control-group">
		<label for="">Título:</label>
		<input type="text" class="span12" name="titulo" required="required" data-required="true" data-rangelength="[5,200]" />
	</div>

	<textarea name="texto" id="texto_noticia"></textarea>

	<br />

	<div class="control-group">
		<label for="">Categoria:</label>
		<?php echo Select("categoria",$categorias); ?>
	</div>

	<div class="form-actions">
		<input type="hidden" name="acao" value="add_noticia" />
		<button class="btn btn-primary" type="submit">Adicionar Notícia</button>
		<a href="<?php echo ROOT ?>admin/noticias" class="btn">Cancelar</a>
	</div>
</form>