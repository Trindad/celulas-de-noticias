<div class="page-header">
	<h1>Adicionar categoria</h1>
</div>

<form action="<?php echo ROOT ?>admin/forms.php" method="post" data-validate="parsley">
	<div class="control-group">
		<label for="">Descrição:</label>
		<input type="text" class="span12" name="descricao" required="required" data-required="true" data-rangelength="[4,30]" />
	</div>

	<div class="control-group">
		<label for="">Categoria Pai:</label>
		<?php echo Select("categoria",$categorias); ?>
	</div>

	<div class="form-actions">
		<input type="hidden" name="acao" value="add_categoria" />
		<button class="btn btn-primary" type="submit">Adicionar Categoria</button>
		<a href="<?php echo ROOT ?>admin/categorias" class="btn">Cancelar</a>
	</div>
</form>