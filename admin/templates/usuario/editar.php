<div class="page-header">
	<h1>Editar usuario</h1>
</div>

<form action="<?php echo ROOT ?>admin/forms.php" method="post" data-validate="parsley">
	<div class="control-group">
		<label for="">Nome:</label>
		<input type="text" class="span4" name="nome" required="required" value="<?php echo $usuario->nome ?>" data-required="true"/>
	</div>

	<div class="control-group">
		<label for="">Login:</label>
		<input type="text" class="span4" name="login" required="required" value="<?php echo $usuario->login ?>" data-required="true" data-rangelength="[4,20]"/>
	</div>
	<div class="control-group">
		<label for="">E-mail:</label>
		<input type="email" class="span4" name="email" required="required" value="<?php echo $usuario->email ?>" data-required="true" data-type="email"/>
	</div>

	<div class="control-group">
		<label for="">Senha:</label>
		<input type="password" class="span4" name="senha"/>
		<span class='help-inline'>Deixe a senha em branco para não alterá-la</span>
	</div>

	<div class="form-actions">
		<input type="hidden" name="acao" value="editar_usuario" />
		<input type="hidden" name="id" value="<?php echo $usuario->id ?>" />

		<button class="btn btn-primary" type="submit">Salvar Alterações</button>
		<a href="<?php echo ROOT ?>admin/usuarios" class="btn">Cancelar</a>
	</div>
</form>