<div class="page-header">
	<h1>Adicionar usuario</h1>
</div>

<form action="<?php echo ROOT ?>admin/forms.php" method="post" data-validate="parsley">
	<div class="control-group">
		<label for="">Nome:</label>
		<input type="text" class="span4" name="nome" required="required" data-required="true" />
	</div>

	<div class="control-group">
		<label for="">Login:</label>
		<input type="text" class="span4" name="login" required="required" data-required="true" data-rangelength="[4,20]" />
	</div>
	<div class="control-group">
		<label for="">E-mail:</label>
		<input type="email" class="span4" name="email" required="required" data-required="true" data-type="email" />
	</div>

	<div class="control-group">
		<label for="">Senha:</label>
		<input type="password" class="span4" name="senha" required="required" data-required="true" data-rangelength="[4,20]" />
	</div>
	<div class="form-actions">
		<input type="hidden" name="acao" value="add_usuario" />
		<button class="btn btn-primary" type="submit">Adicionar Usuario</button>
		<a href="<?php echo ROOT ?>admin/usuarios" class="btn">Cancelar</a>
	</div>
</form>