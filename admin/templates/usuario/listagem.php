
<legend>Listagem de Usuarios</legend>

<p>
	<a href="<?php echo ROOT ?>admin/usuarios/adicionar" title="Adicionar Usuario" class='btn btn-primary'>Adicionar Usuario</a>
</p>

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nome</th>
			<th>Login</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
		<?php if ($usuarios): ?>
			<?php foreach ($usuarios as $usuario): ?>
				<tr>
					<td><?php echo $usuario->id ?></td>
					<td><?php echo $usuario->nome ?></td>
					<td><?php echo $usuario->login ?></td>
					<td>
						<a href="<?php echo ROOT."admin/usuarios/editar/{$usuario->id}"; ?>" class='btn'><i class='icon-edit'></i></a>
						<a href="<?php echo ROOT."admin/usuarios/deletar/{$usuario->id}"; ?>" class='btn btn-danger deletar_usuario'><i class='icon-white icon-trash'></i></a>
					</td>
				</tr>
			<?php endforeach ?>
		<?php else: ?>
			<tr>
				<td colspan="4">Nenhum usuario cadastrado...</td>
			</tr>
		<?php endif ?>
	</tbody>
</table>
<?php echo $paginacao ?>