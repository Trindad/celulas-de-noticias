<div class="page-header">
	<h1>Editar categoria</h1>
</div>

<form action="<?php echo ROOT ?>admin/forms.php" method="post" data-validate="parsley">
	<div class="control-group">
		<label for="">Descrição:</label>
		<input type="text" class="span12" name="descricao" required="required" value="<?php echo $categoria->descricao ?>" data-required="true" data-rangelength="[4,30]" />
	</div>

	<div class="control-group">
		<label for="">Categoria:</label>
		<?php echo Select("categoria",$categorias, $categoria->categoria_pai); ?>
	</div>

	<div class="form-actions">
		<input type="hidden" name="acao" value="editar_categoria" />
		<input type="hidden" name="id" value="<?php echo $categoria->id ?>" />

		<button class="btn btn-primary" type="submit">Salvar Alterações</button>
		<a href="<?php echo ROOT ?>admin/categorias" class="btn">Cancelar</a>
	</div>
</form>